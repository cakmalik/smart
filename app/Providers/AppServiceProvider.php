<?php

namespace App\Providers;

use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Support\ServiceProvider;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\Facades\Animation;
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
        SpladeTable::defaultSearchDebounce(1000);

        Input::defaultDateFormat('d-m-Y');
        Input::defaultTimeFormat('H:i');
        Input::defaultDatetimeFormat('d-m-Y H:i');

        SpladeTable::defaultPerPageOptions([50, 100]);
        SpladeTable::hidePaginationWhenResourceContainsOnePage();
        SpladeTable::defaultColumnCanBeHidden(false);

        Splade::defaultToast(function ($toast) {
            $toast->info()->leftBottom()->autoDismiss(10);
        });

        Animation::new(
            name: 'slide-left',
            enter: 'transform transform ease-in-out duration-300',
            enterFrom: 'opacity-0 -translate-x-full',
            enterTo: 'opacity-100 translate-x-0',
            leave: 'transform transform ease-in-out duration-300',
            leaveFrom: 'opacity-100 translate-x-0',
            leaveTo: 'opacity-0 -translate-x-full',
        );

        Animation::new(
            name: 'slide-right',
            enter: 'transform ease-in-out duration-300',
            enterFrom: 'opacity-0 translate-x-full',
            enterTo: 'opacity-100 translate-x-0',
            leave: 'transform ease-in-out duration-300',
            leaveFrom: 'opacity-100 translate-x-0',
            leaveTo: 'opacity-0 translate-x-full',
        );
    }
}
