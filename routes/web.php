<?php

use App\Models\BakidSetting;
use App\Jobs\JobSendWhatsapp;
use App\Jobs\ReminderAdmission;
use App\Jobs\JobReminderAdmission;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Models\Informal\InformalEducation;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DormitoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BakidSettingController;
use App\Http\Controllers\FormatMessageController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\FormalEducationController;
use App\Http\Controllers\InformalEducationController;
use App\Http\Controllers\ReminderNotificationController;
use App\Jobs\JobSendWhatsappReminder;
use App\Services\WhatsappService;
use ProtoneMedia\Splade\Facades\Toast;

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
        'can:access users'
    ])->group(function () {
        Route::resource('/user', UserController::class);
    });

    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::prefix('wali')->group(function () {
            Route::get('/student/family', [UserController::class, 'familyMembers'])->name('student.families');
        });

        Route::post('/student/complete-admission', [StudentController::class, 'completeEducation'])->name('student.complete-education');
        Route::post('/student/complete-room', [StudentController::class, 'completeRoom'])->name('student.complete-room');

        // students
        // Route::group(['middleware' => ['role_or_permission:access students']], function () {
        // Route::get('/student/{student:nis}/show', [StudentController::class, 'show'])->name('student.show');
        // Route::get('/student/{student:nis}/edit', [StudentController::class, 'edit'])->name('student.edit');
        Route::get('/student/new', [StudentController::class, 'newStudent'])->name('student.new');
        Route::resource('/student', StudentController::class);
        Route::get('/student/{student:nis}/biodata-pdf', [StudentController::class, 'biodataPdf'])->name('student.pdf.biodata');
        Route::get('/student/{student:nis}/mou-pdf', [StudentController::class, 'mouPdf'])->name('student.pdf.mou');
        Route::get('/student/{student:nis}/kts', [StudentController::class, 'kts'])->name('student.kts');
        Route::get('/student/{student:nis}/verify', [StudentController::class, 'verify'])->name('student.verify');
        Route::get('/student/{student:nis}/k-mahrom', [StudentController::class, 'kMahrom'])->name('student.k-mahrom');
        // });

        Route::prefix('setting')->group(function () {
            Route::resource('format-message', FormatMessageController::class);
        });

        Route::resource('/setting', BakidSettingController::class);


        Route::get('tes/wa', [BakidSettingController::class, 'checkConnection'])->name('test.wa');
        Route::get('tes/message', function () {
            $ms = new WhatsappService();
            $ms->tesMessage();
            Toast::success('sedang dikirim...')->autoDismiss(3)->centerBottom();
            return back();
        })->name('tes.message');
        Route::resource('/room', RoomController::class);
        Route::get('/dormitory/room/{dormitory}', [DormitoryController::class, 'room'])->name('dormitory.room');
        Route::resource('/dormitory', DormitoryController::class);
        Route::resource('/formal', FormalEducationController::class);
        Route::resource('/informal', InformalEducationController::class);

        Route::get('/payment/choose-method/{invoice_number}', [PaymentMethodController::class, 'chooseMethod'])->name('payment.choose-method');
        Route::post('/payment/change-method/', [PaymentMethodController::class, 'changeMethod'])->name('payment.change-method');

        Route::get('/invoice/list', [InvoiceController::class, 'index'])->name('invoice.index');
        Route::post('/upload-proof', [InvoiceController::class, 'uploadProof'])->name('invoice.upload-proof');
        Route::get('/invoice/show/{invoice_number}', [InvoiceController::class, 'show'])->name('invoice.show');

        Route::post('/reminder/store', [ReminderNotificationController::class, 'store'])->name('reminder.registration');

        Route::get('/coba', function () {
            return view('bakid.education.formal.show');
        });
        Route::get('/change-background', [BakidSettingController::class, 'changeBackground'])->name('setting.change-bg');
    });
});

Route::get('/nota/{reference}', [TransactionController::class, 'invoice'])->name('pay.invoice');

// without middleware
Route::get('/test', function () {
    $whatsapp = new \App\Services\WhatsappService();
    $whatsapp->send('085333920007');
});

// fungsi berikut sudah jalan
Route::get('/tes-job', function () {
    JobReminderAdmission::dispatch();
    return 'ok';
});

Route::get('/cc', function () {
    $snappy = \App::make('snappy.image');
    $html = view('coba')->render();
    $snappy->setOption('width', '85.6mm');
    $snappy->setOption('height', '53.98mm');
    $nameImage = \Str::random(5) . '.jpg';
    $snappy->generateFromHtml($html, public_path($nameImage));

    dd($snappy);
});
