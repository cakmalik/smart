<?php

namespace App\Tables\Bakid;

use Illuminate\Http\Request;
use App\Models\Bakid\Dormitory;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;
use App\Models\Student\StudentInOutPermission;

class Permittion extends AbstractTable
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
        return StudentInOutPermission::query()
            ->with('student', 'type')
            ->orderByDesc('updated_at');
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $dormitories = Dormitory::filter(Auth::user()->gender == 'male' ? 'L' : 'P')->get();

        $transformedArray = $dormitories->mapWithKeys(function ($dormitory) {
            return [$dormitory['id'] => $dormitory['name']];
        })->toArray();

        $table
            ->withGlobalSearch(columns: ['id'])
            ->column('id')
            ->column('student.name')
            ->column('asrama')
            ->column('type.name')
            ->column('duration')
            ->column('formattedOutTime', label: 'out time')
            ->column('formattedInTime', label: 'in time')
            ->column('is_late')
            ->paginate(10);


        // ->selectFilter(
        //     key: 'dormitory.id',
        //     options: $transformedArray,
        //     label: 'asrama',
        //     noFilterOption: true,
        //     noFilterOptionLabel: 'Semua'
        // );
    }
}
