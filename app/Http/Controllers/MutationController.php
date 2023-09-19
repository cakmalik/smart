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
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Informal\InformalEducation;
use App\Models\Formal\FormalEducationClass;
use App\Models\Student\FormalEducationStudent;
use App\Models\Informal\InformalEducationClass;
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

    public function mutation(Student $student)
    {
        $student = $student->load(['formal', 'informal', 'dormitory', 'room']);
        $formal = FormalEducation::all();
        $informal = InformalEducation::all();
        return view('bakid.mutation.manage', compact('student', 'formal', 'informal'));
    }

    public function update(Request $request, Student $student)
    {
        $mutation_status = null;
        DB::beginTransaction();
        //uniq code
        $code = 'MUT' . date('Ymd') . rand(1000, 9999);
        try {
            if ($request->dormitory_id && $request->room_id) {
                $room_s = RoomStudent::firstOrNew(['student_id' => $student->id]);

                //get name dormitory
                $dormitory = Dormitory::find((int)$request->dormitory_id);
                $room = Room::find($request->room_id);

                //mutation history
                $mutation = new MutationHistory();
                $mutation->student_id = $student->id;
                $mutation->code = $code;
                $mutation->before = $student->getAsramaName();
                $mutation->after = $dormitory->name . '-' . $room->name;
                $mutation->created_by = auth()->user()->id;
                $mutation->marker = 'asrama';
                $mutation->save();


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

                //get name formal
                $formal_education = FormalEducation::find($request->formal_id);
                $formal_class = FormalEducationClass::find($request->formal_class_id);

                //mutation history
                $mutation = new MutationHistory();
                $mutation->student_id = $student->id;
                $mutation->code = $code;
                $mutation->before = $student->getFormalName();
                $mutation->after = $formal_education->name . '-' . $formal_class->class_name;
                $mutation->created_by = auth()->user()->id;
                $mutation->marker = 'formal';
                $mutation->save();

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

                //get name informal
                $informal_education = InformalEducation::find($request->informal_id);
                $informal_class = InformalEducationClass::find($request->informal_class_id);

                //mutation history
                $mutation = new MutationHistory();
                $mutation->student_id = $student->id;
                $mutation->code = $code;
                $mutation->before = $student->getInformalName();
                $mutation->after = $informal_education->name . '-' . $informal_class->class_name;
                $mutation->created_by = auth()->user()->id;
                $mutation->marker = 'informal';
                $mutation->save();



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
            throw $th;
        }
        if ($mutation_status) {
            Toast::success('Mutasi Berhasil');
        } else {
            Toast::danger('Mutasi Gagal');
        }

        return redirect()->route('mutation.index');
    }

    public function dropout(Student $student)
    {
        try {
            $do = new MutationHistory();
            $do->student_id = $student->id;
            $do->code = 'DO' . date('Ymd') . rand(1000, 9999);
            $do->before = $student->getAsramaName();
            $do->after = null;
            $do->created_by = auth()->user()->id;
            $do->marker = 'drop-out';
            $do->save();

            $student->drop_out_at = now();
            $student->save();

            Toast::success('Drop Out Berhasil');
            return redirect()->route('mutation.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
