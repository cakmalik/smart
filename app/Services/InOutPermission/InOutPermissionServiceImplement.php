<?php

namespace App\Services\InOutPermission;

use LaravelEasyRepository\Service;
use App\Repositories\InOutPermission\InOutPermissionRepository;

class InOutPermissionServiceImplement extends Service implements InOutPermissionService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(InOutPermissionRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
