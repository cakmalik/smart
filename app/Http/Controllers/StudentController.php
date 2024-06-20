<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Invoice;
use App\Models\Student;
use App\Tables\Students;
use App\Tables\Bakid\Alumni;
use Illuminate\Http\Request;
use App\Models\Bakid\Dormitory;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\User\UserService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Student\RoomStudent;
use Illuminate\Support\Facades\Log;
use App\Jobs\JobSendWhatsappMessage;
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
use App\Tables\Bakid\Students as BakidStudents;
use App\Models\Student\InformalEducationStudent;
use App\Tables\Bakid\NewStudent as BakidNewStudents;

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

        $this->middleware('role:admin|santri|sekretaris|bendahara|hankamtib|admin_daerah');
        $this->middleware('role:santri')->only('create', 'store');
        // $this->middleware('role:hankamtib')->only('index');

        $this->loc = $locationService;
        $this->student = $studentService;
        $this->invoice = $invoiceService;
        $this->user = $userService;
    }

    public function index(Request $request)
    {
        return view('bakid.student.index', ['students' => BakidStudents::class, 'title' => 'Students']);
    }

    function alumni(Request $request)
    {
        return view('bakid.student.alumni', ['students' => Alumni::class]);
    }

    public function newStudent(Request $request)
    {
        return view('bakid.student.index', [
            'students' => BakidNewStudents::class,
            'title' => 'New Students',
        ]);
    }

    public function create()
    {
        if ($this->user->isHasNotSetPaymentMethod()) {
            Toast::title('Maaf!')->message('Mohon lengkapi metode pembayaran anda terlebih dahulu, sebelum menambah anggota keluarga baru.')->danger()->rightBottom()->backdrop();
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
        if(!$request->has('father_name')){
            $request->merge(['father_name' => '-', 'mother_name' => '-']);
        }
        DB::beginTransaction();
        try {
            $student = $this->student->storeNewStudent($request);
            if ($student['status'] === false) {
                Toast::title('Maaf!')->message('Terjadi kesalahan menyimpan data, silahkan kembali dan coba lagi')->danger()->center()->backdrop()->autoDismiss(5);
                return;
            }
            $invoiceService = $this->invoice->createInvoiceAdmission($student['student_id']);
            if ($invoiceService['status'] === false) {
                Toast::title('Maaf!')->message('Terjadi kesalahan membuat tagihan, silahkan kembali dan coba lagi')->danger()->center()->backdrop()->autoDismiss(5);
                return;
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Toast::title('Maaf!')->message('Terjadi kesalahan, silahkan kembali dan coba lagi')->danger()->center()->backdrop()->autoDismiss(5);
            return;
        }

        Toast::title('Alhamdulillah!')
            ->message($student['message'])
            ->success()
            ->rightBottom()
            ->backdrop()
            ->autoDismiss(5);
        return redirect()->route('dashboard');
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
                'u.doc_kk as doc_kk',
                'u.kk as kk',
                DB::raw('(SELECT COUNT(*) FROM students AS s2 WHERE s2.user_id = students.user_id) AS brothers_count'),
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
        // dd($request->user['kk']);
        $student = $this->student->updateStudent($request, $student);
        if ($student['status'] === false) {
            Toast::title('Maaf!')
                ->message($student['message'])
                ->danger()
                ->rightBottom()
                // ->backdrop()
                ->autoDismiss(3);
            return back();
        } else {
            Toast::title('Alhamdulillah!')
                ->message($student['message'])
                ->success()
                ->rightBottom()
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
        try {
            // ini yg berkaitan:
            // InformalEducationStudent::where('student_id', $student->id)->delete();
            // Invoice::where('student_id', $student->id)->delete();
            // RoomStudent::where('student_id', $student->id)->delete();

            $student->delete();

            Toast::title('Berhasil dihapus!')
                ->message('Santri: ' . $student->name . ' di hapus')
                ->success()
                ->autoDismiss(3)
                ->rightBottom();
                
            return redirect()->route('student.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Toast::title('Maaf!')->message('Terjadi kesalahan, silahkan kembali dan coba lagi')->danger()->rightBottom()->autoDismiss(3);
            return back();
        }
    }

    public function completeEducation(Request $request)
    {
        $request->validate(
            [
                'student_id' => 'required|exists:students,id',
                'formal_id' => 'sometimes|required_without:informal_id',
                'informal_id' => 'sometimes|required_without:formal_id',
                // 'formal_class_id' => 'sometimes|required_without:informal_class_id',
                // 'informal_class_id' => 'sometimes|required_without:formal_class_id',
            ],
            [
                'student_id.required' => 'Mohon pilih putra/i terlebih dahulu',
                'student_id.exists' => 'Siswa tidak ditemukan',
            ],
        );

        try {
            DB::beginTransaction();
            $student = Student::findOrFail((int) $request->student_id);
            $student->education_updated = now();
            $student->save();

            if ($request->formal_id && $request->formal_class_id) {
                FormalEducationStudent::create([
                    'student_id' => $student->id,
                    'formal_education_id' => $request->formal_id,
                    'formal_education_class_id' => $request->formal_class_id,
                    'status' => 'waiting',
                    'year' => date('Y'),
                ]);
            }
            if ($request->informal_id && $request->informal_class_id) {
                InformalEducationStudent::create([
                    'student_id' => $student->id,
                    'informal_education_id' => $request->informal_id,
                    'informal_education_class_id' => $request->informal_class_id,
                    'status' => 'waiting',
                    'year' => date('Y'),
                ]);
            }
            DB::commit();
            Toast::title('Berhasil!')->message('Pendidikan ananda sedang diajukan')->success()->rightBottom()->backdrop()->autoDismiss(5);
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function completeRoom(Request $request)
    {
        $request->validate(
            [
                'student_id' => 'required|exists:students,id',
                // 'room_id' => 'required|exists:rooms,id',
            ],
            [
                'student_id.required' => 'Mohon pilih putra/i terlebih dahulu',
                'student_id.exists' => 'Data tidak ditemukan',
                // 'room_id.required' => 'Mohon pilih Asrama terlebih dahulu',
                // 'room_id.exists' => 'Asrama tidak ditemukan',
            ],
        );

        try {
            DB::beginTransaction();
            if ($request->room_id != null) {
                RoomStudent::create([
                    'student_id' => $request->student_id,
                    'dormitory_id' => $request->dormitory_id,
                    'room_id' => $request->room_id,
                    'status' => 'waiting',
                ]);
            }
            DB::commit();
            Toast::title('Berhasil!')->message('Ruangan ananda sedang diajukan')->success()->rightBottom()->backdrop()->autoDismiss(5);
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage() . ' - ' . $e->getLine());
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function verify(Student $student)
    {
        // cek dlu apakah sudah bayar
        $is_paid = Invoice::where('student_id', $student->id)
            ->where('status', 'paid')
            ->whereHas('invoiceCategory', function ($q) {
                $q->where('name', 'Penerimaan Santri Baru');
            })
            ->exists();

        if (!$is_paid) {
            Toast::danger('Gagal, Mohon selesaikan pembayaran terlebih dahulu');
            return back();
        }
        DB::beginTransaction();
        try {
            $student->verified_at = now();
            $student->status = 'accepted';
            $student->save();

            //student room
            $room = RoomStudent::where('student_id', $student->id)->first();
            if ($room) {
                $room->status = 'approved';
                $room->save();
            }

            //student education
            $formal = FormalEducationStudent::where('student_id', $student->id)->first();
            if ($formal) {
                $formal->status = 'approved';
                $formal->save();
            }

            $informal = InformalEducationStudent::where('student_id', $student->id)->first();
            if ($informal) {
                $informal->status = 'approved';
                $informal->save();
            }

            if ($student->phone != '-') {
                JobSendWhatsappMessage::dispatch($student->phone, 'Pendaftaran santri baru. Terima kasih');
            }
            JobSendWhatsappMessage::dispatch($student->user->phone, 'Pendaftaran santri baru. Terima kasih');

            DB::commit();
            Toast::message('Berhasil diterima sebagai santri, Pesan wa terkirim')->success()->autoDismiss(5)->centerBottom();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
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