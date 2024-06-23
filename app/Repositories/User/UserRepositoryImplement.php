<?php

namespace App\Repositories\User;

use App\Models\Invoice;
use App\Models\InvoiceCategory;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Implementations\Eloquent;

class UserRepositoryImplement extends Eloquent implements UserRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * getByEmail
     *
     * @param  mixed $email
     * @return void
     */
    public function getByEmail($email)
    {
        $this->model->where('email', $email)->get();
    }

    public function getFamilies()
    {
        $user = Auth::user();
        $students = $user->students;
        return $students;
    }

    public function isHasNotSetPaymentMethod(): bool
    {
        $user = Auth::user();
        $invoiceCategoryCode = 'psb';

        $isExist = DB::table('invoices')->join('invoice_categories as ic', 'invoices.invoice_category_id', '=', 'ic.id')
            ->join('students as s', 'invoices.student_id', '=', 's.id')
            ->where('s.deleted_at',null)
            ->where('ic.code', $invoiceCategoryCode)
            ->where('invoices.user_id', $user->id)
            ->whereNull('invoices.payment_method_id')
            ->exists();
        return !!$isExist;
    }
}