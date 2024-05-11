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
        $data = Invoice::query()
        ->selectRaw('*, concat("Rp ", format(amount, 0)) as amount')
        ->with('student', 'method', 'invoiceCategory')
        ->whereHas('student', function ($q) {
        });
        return $data;
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
            ->column(key: 'method.name', label: 'Payment method', sortable: true)
            // ->column('title', sortable: true)
            // ->column('description', sortable: true)
            ->column(key:'invoiceCategory.name', label: 'Category', sortable: true)
            ->column('amount', sortable: true)
            ->column('status', sortable: true)
            ->column(key: 'student.name', label: 'Student', sortable: true)
            ->paginate()
            ->selectFilter(
                key: 'status',
                label: 'Status',
                options: [
                    'paid' => 'Paid',
                    'unpaid' => 'Unpaid',
                ],
            )
            ->selectFilter(
                key: 'method_id',
                label: 'Payment method',
                options: [
                    1 => 'Credit card',
                    2 => 'Paypal',
                    3 => 'Bank transfer',
                ],
            )
            ->withGlobalSearch(columns: ['id', 'invoice_number', 'title', 'description', 'amount'])
            ->column('action', label: 'Action');
    }
}