<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Services\Location\LocationService;
use App\Services\Student\StudentService;
use App\Services\User\UserService;

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
        $globalSearch =
            $students = QueryBuilder::for(Student::class)
            ->defaultSort('name')
            ->allowedSorts(['name'])
            // ->allowedFilters(['name', 'email', $globalSearch])
            ->paginate()
            ->withQueryString();
        return view('bakid.student.index', [
            'students' => SpladeTable::for($students)
                ->defaultSort('name')
                ->column('name', sortable: true, searchable: true, canBeHidden: false)
                ->column('action')
                ->selectFilter('name', [
                    'name' => 'name',
                ])

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
        // $student_data = $request->except([
        //     'father_name',
        //     'father_nik',
        //     'father_phone',
        //     'father_education',
        //     'father_job',
        //     'father_income',
        //     'mother_name',
        //     'mother_nik',
        //     'mother_phone',
        //     'mother_education',
        //     'mother_job',
        //     'mother_income',
        // ]);
        // $student_data['user_id'] = auth()->user()->id;
        // $student = Student::create($student_data);
        $this->student->create($request);
        Toast::title('Alhamdulillah!')
            ->message('Data berhasil disimpan')
            ->success()
            ->rightTop()
            ->backdrop()
            ->autoDismiss(5);
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
