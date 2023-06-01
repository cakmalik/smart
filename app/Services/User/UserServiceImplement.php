<?php

namespace App\Services\User;

use Exception;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use App\Repositories\User\UserRepository;

class UserServiceImplement extends Service implements UserService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(UserRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }
    public function getByEmail($email)
    {
        try {
            return $this->mainRepository->getByEmail($email);
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return [];
        }
    }
}
