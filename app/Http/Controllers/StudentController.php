<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use Database\Factories\InvoiceFactory;
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\Storage;
use App\Services\Student\StudentService;
use App\Http\Requests\StoreStudentRequest;
use App\Services\Location\LocationService;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student\FormalEducationStudent;
use App\Models\Student\InformalEducationStudent;

class StudentController extends Controller
{
    private $loc;
    private $student;
    /**
     * __construct
     *
     * @param  mixed $locationService
     * @param  mixed $studentService
     * @return void
     */

    public function __construct(LocationService $locationService, StudentService $studentService)
    {
        $this->loc = $locationService;
        $this->student = $studentService;
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhere('nickname', 'LIKE', "%{$value}%");
                });
            });
        });
        $globalSearch =
            $students = QueryBuilder::for(Student::class)
            ->defaultSort('name')
            // ->allowedSorts(['name', 'email'])
            ->allowedFilters(['name', 'nickname', $globalSearch])
            ->paginate()
            ->withQueryString();
        return view('bakid.student.index', [
            'students' => SpladeTable::for($students)
                // ->defaultSort('name')
                ->column('name', sortable: true, searchable: true, canBeHidden: false)
                ->withGlobalSearch()
                // ->rowLink(fn (student $student) => route('student.show', $student))
                ->column('action')
            // ->selectFilter('name', [
            //     'name' => 'name',
            // ])

        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
        $student = $this->student->storeNewStudent($request);
        //create invoice
        
        if ($student['status'] === false) {
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
            $student = Student::findOrFail((int)$request->student_id);
            $student->room()->attach($request->room_id, ['status' => 'waiting']);
            $student->save();
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
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
