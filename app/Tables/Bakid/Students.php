<?php

namespace App\Tables\Bakid;

use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Bakid\Dormitory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use ProtoneMedia\Splade\AbstractTable;
use Spatie\QueryBuilder\AllowedFilter;

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

        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%");
                });
            });
        });
 
        return QueryBuilder::for(Student::class)
            ->defaultSort('name')
            ->allowedSorts(['name','nis','district','city','verified_at'])
            ->allowedFilters(['name','verified_at', $globalSearch]);
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
        // REMEMBER: MYSQL dan POSTGRES berbeda
        // kalau mysql seperti ini :
        // $years = DB::table('students')->whereNotNull('verified_at')->distinct()->pluck(DB::raw('YEAR(verified_at) as year'))->toArray();

        $years = DB::table('students')
        ->whereNotNull('verified_at')
        ->distinct()
        ->pluck(DB::raw('YEAR(verified_at) as year'))
        ->toArray();

        // Transformasikan array tahun ke format yang diinginkan menggunakan mapWithKeys
        $transformedYears = collect($years)->sortDesc()->mapWithKeys(function ($year) {
            return [$year => $year];
        })->toArray();

        // kalau postgres seperti ini :
        // $years = Student::selectRaw('distinct extract(year from verified_at) as year')->whereNotNull('verified_at')->pluck('year')->toArray();

        // Tambahkan pilihan 'Semua' ke pilihan tahun
        $table
            ->withGlobalSearch(columns: ['name', 'parent.father_name'])
            ->defaultSort('name')
            ->column('nis', sortable: true)
            ->column(key: 'name', label: 'Nama', sortable: true)
            ->column(key:'nickname', label:'Panggilan', sortable: true)
            ->column('gender')
            ->column('asrama')
            ->column('family', 'saudara', canBeHidden: true)
            ->column(
                key: 'district',
                as: fn ($district) => Str::upper($district),
                label: 'Kecamatan',
                sortable: true,
                canBeHidden: true
            )
            ->column(
                key: 'city',
                as: fn ($city) => Str::upper($city),
                label: 'Kota/Kab.',
                sortable: true,
                canBeHidden: true
            )

            ->selectFilter(
                key: 'dormitory.id',
                options: $transformedArray,
                label: 'Asrama',
                noFilterOption: true,
                noFilterOptionLabel: 'Semua'
            )
            // use filter search with callback
            ->selectFilter(
                key: 'verified_at',
                options: $transformedYears, // Gunakan pilihan tahun yang telah dibuat
                label: 'Tahun',
                noFilterOption: true,
                noFilterOptionLabel: 'Semua',
            )
            ->rowModal(fn (Student $s) => route('student.show', ['student' => $s->id]))
            ->paginate(10);
    }
}