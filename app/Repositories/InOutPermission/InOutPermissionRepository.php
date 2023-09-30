<?php

namespace App\Repositories\InOutPermission;

use LaravelEasyRepository\Repository;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

interface InOutPermissionRepository extends Repository
{
    public function isLoggedOut($student_id): bool;

    public function storeIn($student_id, $request);

    public function storeOut($student_id);
}
