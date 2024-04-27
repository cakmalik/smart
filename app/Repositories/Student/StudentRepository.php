<?php

namespace App\Repositories\Student;

use App\Models\Student;
use Illuminate\Support\Collection;
use LaravelEasyRepository\Repository;

interface StudentRepository extends Repository
{
    function findNis($nis): Student;

    public function createParent($data);

    public function updateParent($data, $student);

    public function updateAsrama($dormitory_id, $room_id, $student);
}