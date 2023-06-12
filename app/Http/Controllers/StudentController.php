<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\Storage;
use App\Services\Student\StudentService;
use App\Http\Requests\StoreStudentRequest;
use App\Services\Location\LocationService;
use App\Http\Requests\UpdateStudentRequest;

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
        return view('bakid.student.edit', compact('student'));
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
