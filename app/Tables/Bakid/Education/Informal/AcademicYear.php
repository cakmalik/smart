<?php

namespace App\Tables\Bakid\Education\Informal;

use App\Models\Informal\InformalEducationAcademicYear as Model;
use App\Models\UserHasInformalEducationPermission;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class AcademicYear extends AbstractTable
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
        $user= auth()->user();
        $informal_id = $user->educations?->first()->id;
        return Model::query()->where('informal_education_id', $informal_id);
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['id'])
            ->column('id', sortable: true)
            ->column('code', sortable: true)
            ->column(
                key: 'semester',
                label: 'Kwartal',
                canBeHidden: true,
                hidden: false,
                sortable: true,
                searchable: true
            )
            ->column('year', sortable: true)
            ->column('status');
    }
}