<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Bakid\Room;
use Illuminate\Http\Request;
use App\Models\Bakid\Dormitory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Student\RoomStudent;
use ProtoneMedia\Splade\SpladeTable;
use App\Models\Bakid\MutationHistory;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Formal\FormalEducation;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Informal\InformalEducation;
use App\Models\Student\FormalEducationStudent;
use App\Models\Student\InformalEducationStudent;
use ProtoneMedia\Splade\Facades\Toast;

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
        $mutation_status = null;
        DB::beginTransaction();
        try {
            if ($request->dormitory_id && $request->room_id) {
                $room_s = RoomStudent::firstOrNew(['student_id' => $student->id]);

                MutationHistory::create([
                    'student_id' => $student->id,
                    'model' => 'App\Models\Bakid\RoomStudent',
                    'before_id' => $room_s->room_id,
                    'after_id' => $request->room_id,
                    'marker' => 'Some Marker',
                    'note' => 'Some Note',
                ]);

                $room_s->room_id = $request->room_id;
                $room_s->dormitory_id = $request->dormitory_id;
                $room_s->status = 'approved';
                $room_s->save();

                $mutation_status[] = [
                    'room' => !!$room_s,
                ];

                if ($room_s->exists) {
                    // push notification to student
                }

                //mutation history

            }

            if ($request->formal_id && $request->formal_class_id) {
                $formal = FormalEducationStudent::firstOrNew(['student_id' => $student->id]);

                MutationHistory::create([
                    'student_id' => $student->id,
                    'model' => 'App\Models\Student\FormalEducationStudent',
                    'before_id' => $formal->formal_education_id,
                    'after_id' => $request->formal_id,
                    'marker' => 'Some Marker',
                    'note' => 'Some Note',
                ]);


                $formal->formal_education_id = $request->formal_id;
                $formal->formal_education_class_id = $request->formal_class_id;
                $formal->status = 'accepted';
                $formal->save();

                $mutation_status[] = [
                    'formal' => !!$formal,
                ];

                if ($formal->exists) {
                    // push notification to student
                }
            }

            if ($request->informal_id && $request->informal_class_id) {
                $informal = InformalEducationStudent::firstOrNew(['student_id' => $student->id]);

                MutationHistory::create([
                    'student_id' => $student->id,
                    'model' => 'App\Models\Student\InformalEducationStudent',
                    'before_id' => $informal->informal_education_id,
                    'after_id' => $request->informal_id,
                    'marker' => 'Some Marker',
                    'note' => 'Some Note',
                ]);


                $informal->informal_education_id = $request->informal_id;
                $informal->informal_education_class_id = $request->informal_class_id;
                $informal->status = 'accepted';
                $informal->save();

                $mutation_status[] = [
                    'informal' => !!$informal,
                ];

                if ($informal->exists) {
                    // push notification to student
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
        }
        if ($mutation_status) {
            Toast::success('Mutasi Berhasil');
        } else {
            Toast::danger('Mutasi Gagal');
        }

        return redirect()->route('mutation.index');
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
