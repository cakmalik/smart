<?php

namespace App\Services\User;

use LaravelEasyRepository\BaseService;

interface UserService extends BaseService
{
    /**
     * getByEmail
     *
     * @param  mixed $email
     * @return void
     */
    public function getByEmail($email);

    public function getFamilies();
}
