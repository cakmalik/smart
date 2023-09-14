<?php

namespace App\Http\Controllers;

use App\Models\Bakid\Dormitory;
use App\Models\Bakid\MutationHistory;
use App\Models\Bakid\Room;
use App\Models\Formal\FormalEducation;
use App\Models\Informal\InformalEducation;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class MutationController extends Controller
{
    public function index(Request $request)
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%");
                });
            });
        });

        $students = QueryBuilder::for(Student::class)
            ->with('formal', 'informal')
            ->santri()
            ->allowedFilters(['name', 'nickname', $globalSearch]);

        return view('bakid.mutation.index', [
            'data' => SpladeTable::for($students)
                ->withGlobalSearch()
                ->defaultSort('name')
                ->column('name', sortable: true, searchable: true)
                ->column(key: 'nickname', canBeHidden: true, sortable: true, searchable: true)
                ->column('asrama', canBeHidden: true)
                ->column('formal', canBeHidden: true)
                ->column('non-formal', canBeHidden: true)
                ->rowSlideover(fn (Student $student) => route('student.mutation', $student->nis))
                ->paginate(10)
        ]);
    }

    function mutation(Student $student)
    {
        $student = $student->load(['formal', 'informal', 'dormitory', 'room']);
        $formal = FormalEducation::all();
        $informal = InformalEducation::all();
        return view('bakid.mutation.manage', compact('student', 'formal', 'informal'));
    }

    function update(Request $request, Student $student)
    {
        // $request->validate([
        //     'student_id' => 'required|exists:students,id',
        //     'formal_id' => 'sometimes|required_without:informal_id',
        //     'informal_id' => 'sometimes|required_without:formal_id',
        //     'formal_class_id' => 'sometimes|required_without:informal_class_id',
        //     'informal_class_id' => 'sometimes|required_without:formal_class_id',
        // ], [
        //     'student_id.required' => 'Mohon pilih putra/i terlebih dahulu',
        //     'student_id.exists' => 'Siswa tidak ditemukan',
        // ]);

        dd($request->all(), $student);
    }

    function dropout(Student $student)
    {
        try {
            $do = new MutationHistory();
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
