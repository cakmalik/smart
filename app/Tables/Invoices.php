<?php

namespace App\Tables;

use App\Models\Invoice;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Invoices extends AbstractTable
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
        $formattedData = Invoice::query()
            ->where('status', 'paid')
            ->orderBy('created_at', 'desc');
        // ->map(function ($invoice) {
        //     $invoice->amount = number_format($invoice->amount, 2, ',', '.'); // Ubah format angka
        //     return $invoice;
        // });

        return $formattedData;
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
            ->column('invoice_number', sortable: true)
            ->column(
                key: 'method.name',
                label: 'Payment method',
                sortable: true
            )
            ->column('title', sortable: true)
            ->column('description', sortable: true)
            ->column('amount', sortable: true)
            ->column('status', sortable: true)
            ->paginate(15);
        // ->selectFilter()
        // ->withGlobalSearch()

        // ->bulkAction()
        // ->export()
    }
}
