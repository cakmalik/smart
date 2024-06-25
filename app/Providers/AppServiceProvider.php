<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Google\Service\Drive;
use Illuminate\Support\Facades\Log;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use ProtoneMedia\Splade\Facades\Splade;
use Masbug\Flysystem\GoogleDriveAdapter;

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

        Input::defaultDateFormat('Y-m-d');
        Input::defaultTimeFormat('H:i');
        Input::defaultDatetimeFormat('Y-m-d H:i');

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

        $this->loadGoogleStorageDriver();
    }

   private function loadGoogleStorageDriver(string $driverName = 'google')
    {
        try {
            Storage::extend('google', function ($app, $config) {
                $options = [];

                if (!empty($config['teamDriveId'] ?? null)) {
                    $options['teamDriveId'] = $config['teamDriveId'];
                }

                if (!empty($config['sharedFolderId'] ?? null)) {
                    $options['sharedFolderId'] = $config['sharedFolderId'];
                }

                $client = new \Google\Client();
                $client->setClientId($config['clientId']);
                $client->setClientSecret($config['clientSecret']);
                $client->refreshToken($config['refreshToken']);

                $service = new \Google\Service\Drive($client);
                $adapter = new \Masbug\Flysystem\GoogleDriveAdapter($service, $config['folder'] ?? '/', $options);
                $driver = new \League\Flysystem\Filesystem($adapter);

                return new \Illuminate\Filesystem\FilesystemAdapter($driver, $adapter);
            });
        } catch (\Exception $e) {
            Log::error('gagal mengaktifkan google storage driver', ['error' => $e->getMessage()]);
            // your exception handling logic
        }
    }
}