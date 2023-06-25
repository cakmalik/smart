<?php

namespace App\Repositories\Payment;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Payment;
use App\Models\PaymentMethod;

class PaymentRepositoryImplement extends Eloquent implements PaymentRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(PaymentMethod $model)
    {
        $this->model = $model;
    }
}
