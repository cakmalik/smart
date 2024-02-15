<?php

namespace App\Tables\Bakid;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Bakid\Dormitory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

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
        return Student::query()
            ->with('user', 'room', 'dormitory')
            ->whereNotNull('verified_at');
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

        // Ambil tahun unik dari kolom 'verified_at' dalam model 'Student'
        $years = DB::table('students')->whereNotNull('verified_at')->distinct()->pluck(DB::raw('YEAR(verified_at) as year'))->toArray();

        // Tambahkan pilihan 'Semua' ke pilihan tahun
        $table
            ->withGlobalSearch(columns: ['name', 'parent.father_name'])
            ->defaultSort('name')
            // ->column('id', sortable: true)
            ->column('name', sortable: true)
            ->column('nickname')
            ->column('gender')
            ->column('asrama')
            ->column('family', 'saudara', canBeHidden: true)
            ->column(
                key: 'district',
                label: 'District',
                sortable: true,
                canBeHidden: true
            )
            ->column(
                key: 'city',
                label: 'city',
                sortable: true,
                canBeHidden: true
            )
            ->column('action')
            ->selectFilter(
                key: 'dormitory.id',
                options: $transformedArray,
                label: 'Asrama',
                noFilterOption: true,
                noFilterOptionLabel: 'Semua'
            )
            ->selectFilter(
                key: 'verified_at',
                options: $years, // Gunakan pilihan tahun yang telah dibuat
                label: 'Tahun',
                noFilterOption: true,
                noFilterOptionLabel: 'Semua'
            );
    }
}
