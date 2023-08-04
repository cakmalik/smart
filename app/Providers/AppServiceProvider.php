<?php

namespace App\Providers;

use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Support\ServiceProvider;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\Components\Form\Input;
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

        Input::defaultDateFormat('d-m-Y');
        Input::defaultTimeFormat('H:i');
        Input::defaultDatetimeFormat('d-m-Y H:i');

        SpladeTable::defaultPerPageOptions([50, 100]);
        SpladeTable::hidePaginationWhenResourceContainsOnePage();
        SpladeTable::defaultColumnCanBeHidden(false);

        Splade::defaultToast(function ($toast) {
            $toast->info()->leftBottom()->autoDismiss(10);
        });
    }
}
