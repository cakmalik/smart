<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['splade'])->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function () {
        return view('welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    });

    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::view('/dashboard', 'dashboard')->name('dashboard');
    });

    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
        'role:admin',
    ])->group(function () {
        Route::resource('/user', UserController::class);
    });
    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
        'role:santri|admin',
    ])->group(function () {
        Route::prefix('wali')->group(function () {
            Route::get('/student/family', [UserController::class, 'familyMembers'])->name('student.families');
        });
        Route::resource('/student', StudentController::class);
    });
});

Route::get('/test', function () {
    //    whatsapp service
    $whatsapp = new \App\Services\WhatsappService();
    $whatsapp->send('085333920007');
});

Route::get('/nota/{reference}', [TransactionController::class, 'invoice'])->name('pay.invoice');
