<?php

namespace App\Services\Student;

use LaravelEasyRepository\BaseService;

interface StudentService extends BaseService
{
    public function storeNewStudent($request);
}
