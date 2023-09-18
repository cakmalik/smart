<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Bakid\Room;
use Illuminate\Http\Request;
use App\Models\Bakid\Dormitory;
use Illuminate\Support\Collection;
use App\Models\Student\RoomStudent;
use ProtoneMedia\Splade\SpladeTable;
use App\Models\Bakid\MutationHistory;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Formal\FormalEducation;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Informal\InformalEducation;
use App\Models\Student\FormalEducationStudent;
use App\Models\Student\InformalEducationStudent;

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
        //     'formal_id' => 'sometimes|required_without:informal_id',
        //     'informal_id' => 'sometimes|required_without:formal_id',
        //     'formal_class_id' => 'sometimes|required_without:informal_class_id',
        //     'informal_class_id' => 'sometimes|required_without:formal_class_id',
        // ]);
        $mutation_status = null;
        if ($request->dormitory_id && $request->room_id) {
            $room = RoomStudent::where('student_id', $student->id)->first();
            if ($room) {
                $mutation_history = MutationHistory::create([
                    'student_id' => $student->id,
                    'model' => 'App\Models\Bakid\RoomStudent',
                    'before_id' => $room->room_id,
                    'after_id' => $request->room_id,
                    'marker' => 'Some Marker',
                    'note' => 'Some Note',
                ]);

                $room->room_id = $request->room_id;
                $room->dormitory_id = $request->dormitory_id;
                $room->save();
            }
        }
        if ($request->formal_id && $request->formal_class_id) {
            $formal = FormalEducationStudent::where('student_id', $student->id);
        }
        if ($request->informal_id && $request->informal_class_id) {
            $informal = InformalEducationStudent::where('student_id', $student->id);
        }
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
