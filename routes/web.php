<?php

use App\Models\BakidSetting;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Models\Informal\InformalEducation;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DormitoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BakidSettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormalEducationController;
use App\Http\Controllers\InformalEducationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentMethodController;

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
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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
        Route::post('/student/complete-admission', [StudentController::class, 'completeEducation'])->name('student.complete-education');
        Route::post('/student/complete-room', [StudentController::class, 'completeRoom'])->name('student.complete-room');
        Route::resource('/student', StudentController::class);
        Route::resource('/setting', BakidSettingController::class);
        Route::get('tes/wa', [BakidSettingController::class, 'checkConnection'])->name('test.wa');
        Route::resource('/room', RoomController::class);
        Route::get('/dormitory/room/{dormitory}', [DormitoryController::class, 'room'])->name('dormitory.room');
        Route::resource('/dormitory', DormitoryController::class);
        Route::resource('/informal', InformalEducationController::class);
        Route::resource('/formal', FormalEducationController::class);

        Route::get('/payment/choose-method/{invoice_number}', [PaymentMethodController::class, 'chooseMethod'])->name('payment.choose-method');
        Route::post('/payment/change-method/', [PaymentMethodController::class, 'changeMethod'])->name('payment.change-method');

        Route::get('/invoice/list', [InvoiceController::class, 'index'])->name('invoice.index');
        Route::get('/invoice/show/{invoice_number}', [InvoiceController::class, 'show'])->name('invoice.show');
    });
});

Route::get('/nota/{reference}', [TransactionController::class, 'invoice'])->name('pay.invoice');

// without middleware
Route::get('/test', function () {
    $whatsapp = new \App\Services\WhatsappService();
    $whatsapp->send('085333920007');
});
