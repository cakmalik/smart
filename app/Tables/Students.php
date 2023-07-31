<?php

namespace App\Tables;

use App\Models\Bakid\Dormitory;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOption\Option;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;
use Symfony\Component\HttpFoundation\File\Exception\NoFileException;

class Students extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Student::query();
        // // return Student::query()->with(['user', 'parent', 'room.dormitory']);
        // $students = DB::table('students')
        //     ->join('users as u', 'students.user_id', '=', 'u.id')
        //     ->leftJoin('student_families as parents', 'students.student_family_id', '=', 'parents.id')
        //     //pivot room_students
        //     ->leftJoin('room_students as rs', 'students.id', '=', 'rs.student_id')
        //     ->leftJoin('rooms as r', 'rs.room_id', '=', 'r.id')
        //     ->leftJoin('dormitories as d', 'r.dormitory_id', '=', 'd.id')
        //     ->select(
        //         'students.name',
        //         'students.city',

        //         'parents.father_name',
        //         'u.phone',
        //         'r.dormitory_id as dormitory_id',
        //         DB::raw("CONCAT(d.name, '', r.name) as dormitory_room_name")
        //     )
        //     ->get();
        // // dd($students);
        // return $students;
    }


    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $dormitories = Dormitory::get()->mapWithKeys(function ($dormitory) {
            return [$dormitory->id => $dormitory->name . ' - ' . $dormitory->gender];
        })->toArray();
        $table
            ->withGlobalSearch('Search through the data...', ['name', 'email'])
            ->column('name', sortable: true)
            ->column(key: 'parent.father_name', label: 'Ayah', sortable: false)
            ->column('city', label: 'Kota', sortable: true)
            ->column('phone', label: 'No. HP')
            ->column('dormitory', label: 'Asrama')

            // ->searchInput()
            ->selectFilter(
                key: 'room.dormitory_id',
                label: 'Daerah',
                options: $dormitories,
                noFilterOption: true,
                noFilterOptionLabel: 'Semua Kamar'
            )
            // ->withGlobalSearch()

            // ->bulkAction()
            ->export();
    }
}
