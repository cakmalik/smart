<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Student;
use App\Tables\Students;
use Illuminate\Http\Request;
use App\Models\Bakid\Dormitory;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\User\UserService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use Database\Factories\InvoiceFactory;
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\Storage;
use App\Services\Invoice\InvoiceService;
use App\Services\Student\StudentService;
use App\Http\Requests\StoreStudentRequest;
use App\Services\Location\LocationService;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student\FormalEducationStudent;
use App\Models\Student\InformalEducationStudent;
use App\Models\Student\RoomStudent;
use App\Tables\Bakid\Students as BakidStudents;

class StudentController extends Controller
{
    private $loc;
    private $student;
    private $invoice;
    private $user;
    /**
     * __construct
     *
     * @param  mixed $locationService
     * @param  mixed $studentService
     * @return void
     */

    public function __construct(LocationService $locationService, StudentService $studentService, InvoiceService $invoiceService, UserService $userService)
    {
        // $this->middleware(['role:santri'], ['only' => ['create']]);

        $this->middleware('role:admin|santri|sekretaris|bendahara');
        $this->middleware('role:santri')->only('create', 'store');

        $this->loc = $locationService;
        $this->student = $studentService;
        $this->invoice = $invoiceService;
        $this->user = $userService;
    }


    private function getStudentsQuery(Request $request)
    {
        $daerah = $request->input('dormitory_id');
        $cari = $request->input('search');

        return Student::query()
            ->leftJoin('student_families as parent', 'parent.id', '=', 'students.student_family_id')
            ->leftJoin('room_students as rs', 'students.id', '=', 'rs.student_id')
            ->leftJoin('dormitories as dr', 'dr.id', '=', 'rs.dormitory_id')
            ->leftJoin('rooms as r', 'r.id', '=', 'rs.room_id')
            ->leftJoin('users as u', 'u.id', '=', 'students.user_id')
            ->when($daerah, function ($q) use ($daerah) {
                return $q->where('rs.dormitory_id', $daerah);
            })
            ->when($cari, function ($q) use ($cari) {
                return $q->where('students.name', 'LIKE', '%' . $cari . '%')
                    ->orWhere('students.nickname', 'LIKE', '%' . $cari . '%');
            })
            ->select(
                'students.id as id',
                'students.name as student_name',
                'students.gender as gender',
                'students.nickname as nickname',
                'students.student_image as image',
                'parent.father_name as ayah',
                'parent.father_phone as phone',
                'students.gender',
                'students.city',
                'student_image',
                'dr.name as dormitory_name',
                'r.name as room',
                'students.created_at',
                DB::raw("(SELECT COUNT(*) FROM students AS s2 WHERE s2.user_id = students.user_id) AS brothers_count")
            );
    }

    public function index(Request $request)
    {
        return view(
            'bakid.student.index',
            ['students' => BakidStudents::class]
        );
    }

    public function newStudent(Request $request)
    {
        $students = $this->getStudentsQuery($request)
            ->whereNull('verified_at')
            ->paginate(10)
            ->withQueryString();

        $dormitories = Dormitory::get()->map(function ($i) {
            $gender = $i->gender == 'L' ? 'Laki-laki' : 'Perempuan';
            return [
                'id' => $i->id,
                'name' => '(' . $i->gender . ') ' . $i->name,
            ];
        });
        return view('bakid.student.new_student.index', compact('students', 'dormitories'));
    }


    public function create()
    {
        if ($this->user->isHasNotSetPaymentMethod()) {
            Toast::title('Maaf!')
                ->message('Mohon lengkapi metode pembayaran anda terlebih dahulu, sebelum menambah anggota keluarga baru.')
                ->danger()
                ->rightTop()
                ->backdrop();
            // ->autoDismiss(5);
            return redirect()->route('dashboard');
        }
        return view('bakid.student.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(StoreStudentRequest $request)
    {
        try {
            $student = $this->student->storeNewStudent($request);
            $invoiceService = $this->invoice->createInvoiceAdmission($student['student_id']);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
        if ($student['status'] === false || $invoiceService === false) {
            Toast::title('Maaf!')
                ->message($student['message'])
                ->danger()
                ->rightTop()
                ->backdrop()
                ->autoDismiss(5);
            return back();
        } else {
            Toast::title('Alhamdulillah!')
                ->message($student['message'])
                ->success()
                ->rightTop()
                ->backdrop()
                ->autoDismiss(5);
            return redirect()->route('dashboard');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student = Student::leftJoin('room_students as rs', 'students.id', '=', 'rs.student_id')
            ->leftJoin('dormitories as dr', 'dr.id', '=', 'rs.dormitory_id')
            ->leftJoin('rooms as r', 'r.id', '=', 'rs.room_id')
            ->join('users as u', 'u.id', '=', 'students.user_id')
            ->select(
                'students.id as id',
                'students.name as student_name',
                'students.gender as gender',
                'students.nickname as nickname',
                'students.nis',
                'students.student_image as image',
                // 'parent.father_name as ayah',
                // 'parent.father_phone as phone',
                'students.gender',
                'students.district',
                'students.city',
                'student_image',
                'dr.name as dormitory_name',
                'r.name as room',
                'students.verified_at',
                'u.kk',
                DB::raw("(SELECT COUNT(*) FROM students AS s2 WHERE s2.user_id = students.user_id) AS brothers_count")

            )
            ->where('students.id', $student->id)
            ->first();

        $fileExists = File::exists(public_path('storage/temp_images/' . $student->nis . '.jpg'));
        $fileMahram = File::exists(public_path('storage/temp_images/kk' . $student->kk . '.jpg'));
        // if (!$fileExists) {
        //     (new DocumentController)->kts($student->nis);
        // }

        $student->kts = $fileExists;
        $student->mahram = $fileMahram;

        return view('bakid.student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $student->load('parent');
        return view('bakid.student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student = $this->student->updateStudent($request, $student);
        if ($student['status'] === false) {
            Toast::title('Maaf!')
                ->message($student['message'])
                ->danger()
                ->rightTop()
                // ->backdrop()
                ->autoDismiss(3);
            return back();
        } else {
            Toast::title('Alhamdulillah!')
                ->message($student['message'])
                ->success()
                ->rightTop()
                // ->backdrop()
                ->autoDismiss(3);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }

    public function completeEducation(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'formal_id' => 'sometimes|required_without:informal_id',
            'informal_id' => 'sometimes|required_without:formal_id',
            'formal_class_id' => 'sometimes|required_without:informal_class_id',
            'informal_class_id' => 'sometimes|required_without:formal_class_id',
        ], [
            'student_id.required' => 'Mohon pilih putra/i terlebih dahulu',
            'student_id.exists' => 'Siswa tidak ditemukan',
        ]);

        try {
            DB::beginTransaction();
            $student = Student::findOrFail((int)$request->student_id);
            $student->education_updated = now();
            $student->save();

            if ($request->formal_id && $request->formal_class_id) {
                FormalEducationStudent::create([
                    'student_id' => $student->id,
                    'formal_education_id' => $request->formal_id,
                    'formal_education_class_id' => $request->formal_class_id,
                ]);
            }
            if ($request->informal_id && $request->informal_class_id) {

                InformalEducationStudent::create([
                    'student_id' => $student->id,
                    'informal_education_id' => $request->informal_id,
                    'informal_education_class_id' => $request->informal_class_id,
                ]);
            }
            DB::commit();
            Toast::title('Berhasil!')
                ->message('Pendidikan ananda sedang diajukan')
                ->success()
                ->rightTop()
                ->backdrop()
                ->autoDismiss(5);
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function completeRoom(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'room_id' => 'required|exists:rooms,id',
        ], [
            'student_id.required' => 'Mohon pilih putra/i terlebih dahulu',
            'student_id.exists' => 'Data tidak ditemukan',
            'room_id.required' => 'Mohon pilih Asrama terlebih dahulu',
            'room_id.exists' => 'Asrama tidak ditemukan',
        ]);

        try {
            DB::beginTransaction();
            RoomStudent::create([
                'student_id' => $request->student_id,
                'dormitory_id' => $request->dormitory_id,
                'room_id' => $request->room_id,
                'status' => 'waiting'
            ]);
            DB::commit();
            Toast::title('Berhasil!')
                ->message('Ruangan ananda sedang diajukan')
                ->success()
                ->rightTop()
                ->backdrop()
                ->autoDismiss(5);
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage() . ' - ' . $e->getLine());
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    function verify(Student $student)
    {
        try {
            $student->verified_at = now();
            $student->save();
            Toast::message('Berhasil diterima sebagai santri, Pesan wa terkirim')->success()->autoDismiss(5)->centerBottom();
            return back();
        } catch (\Exception $e) {
            Toast::danger('Gagal, terjadi kesalahan. periksa log');
            Log::error($e->getMessage() . '-' . $e->getLine());
            return back();
        }
    }

    function biodataPdf(Student $student)
    {
        $student->load('parent');
        $pdf = Pdf::loadView('document.biodata', compact('student'));
        return $pdf->download('invoice.pdf');
    }

    function mouPdf(Student $student)
    {
        $student->load('parent');
        $pdf = Pdf::loadView('document.mou', compact('student'));
        return $pdf->download('invoice.pdf');
    }

    function kts(Student $student)
    {
        return view('document.kts', compact('student'));
    }

    function kMahrom(Student $student)
    {
        return view('document.kartu_mahrom', compact('student'));
    }

    // highlight search
    function search(Request $request)
    {
        if (!empty($request->q)) {
            $students = Student::where('name', 'LIKE', "%{$request->q}%")
                ->orWhere('nickname', 'LIKE', "%{$request->q}%")
                ->limit(9)
                ->get();
            if ($students->count() <= 0) {
                Toast::danger('Tidak ditemukan')->autoDismiss(1)->centerBottom();
            }
            return view('bakid.student.search', compact('students'));
        }
        return view('bakid.student.search');
    }
}
