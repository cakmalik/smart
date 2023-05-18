<?php

namespace App\Repositories;

use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepositoryInterface;

class RepositoryBackendServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }
}
