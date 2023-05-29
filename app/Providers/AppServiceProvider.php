<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ProtoneMedia\Splade\Components\Form\Select;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Select::defaultChoices();
        Select::defaultResetOnNewRemoteUrl();
        // Select::defaultSelectFirstRemoteOption();
    }
}
