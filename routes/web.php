<?php

use Carbon\Carbon;
use App\Models\Announcement;
use App\Models\BakidSetting;
use App\Jobs\JobSendWhatsapp;
use App\Jobs\ReminderAdmission;
use App\Services\WhatsappService;
use App\Jobs\JobReminderAdmission;
use App\Jobs\JobSendWhatsappReminder;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExportController;
use App\Models\Informal\InformalEducation;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\MutationController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DormitoryController;
use App\Http\Controllers\ViolationController;
use App\Models\Student\StudentInOutPermission;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\BakidSettingController;
use App\Http\Controllers\FormatMessageController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\Bakid\ApprovalController;
use App\Http\Controllers\FormalEducationController;
use App\Http\Controllers\InOutPermissionController;
use App\Http\Controllers\InvoiceCategoryController;
use Symfony\Component\CssSelector\Node\FunctionNode;
use App\Http\Controllers\InformalEducationController;
use App\Http\Controllers\InOutPermissionTypeController;
use App\Http\Controllers\FormalEducationClassController;
use App\Http\Controllers\ReminderNotificationController;
use App\Http\Controllers\InformalEducationClassController;
use App\Http\Controllers\StudentInOutPermissionController;
use App\Http\Controllers\InvoiceCategoryDiscountController;
use App\Http\Controllers\InformalEducationStudentController;
use App\Http\Controllers\InformalEducationSubjectController;
use App\Http\Controllers\InformalEducationAcademicYearController;

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
        $now = Carbon::now();
        $announcements = Announcement::where('start_show', '<=', $now)
            ->where('end_show', '>=', $now)
            ->get();

        return view('welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'announcement' => $announcements
        ]);
    });

    // universal route
    Route::get('/announcement/{announcement}/show', [AnnouncementController::class, 'show'])->name('announcement.show');

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
        Route::post('/user/upload-kk/{user}', [UserController::class, 'uploadKk'])->name('user.upload-kk');
        
        Route::get('tes/wa', [BakidSettingController::class, 'checkConnection'])->name('test.wa');
        Route::get('tes/message', function () {
            $ms = new WhatsappService();
            $ms->tesMessage();
            Toast::success('sedang dikirim...')->autoDismiss(3)->centerBottom();
            return back();
        })->name('tes.message');

        Route::prefix('wali')->group(function () {
            Route::get('/student/family', [UserController::class, 'familyMembers'])->name('student.families');
            Route::get('/family-cards', [UserController::class, 'familyCards'])->name('family.cards');
            Route::get('/family-kts', [UserController::class, 'familyKts'])->name('family.kts');
            Route::get('/family-mahrom', [UserController::class, 'familyMahrom'])->name('family.mahrom');
        });

        Route::post('/student/complete-admission', [StudentController::class, 'completeEducation'])->name('student.complete-education');
        Route::post('/student/complete-room', [StudentController::class, 'completeRoom'])->name('student.complete-room');

        // students
        // Route::group(['middleware' => ['role_or_permission:access students']], function () {
        // Route::get('/student/{student:nis}/show', [StudentController::class, 'show'])->name('student.show');
        // Route::get('/student/{student:nis}/edit', [StudentController::class, 'edit'])->name('student.edit');
        Route::get('/student/search', [StudentController::class, 'search'])->name('student.search');
        // Route::post('/student/search', [StudentController::class, 'searchPost']);
        Route::get('/student/new', [StudentController::class, 'newStudent'])->name('student.new');
        Route::get('/alumni', [StudentController::class, 'alumni'])->name('student.alumni');
        Route::resource('/student', StudentController::class);
        Route::get('/student/{student:nis}/biodata-pdf', [StudentController::class, 'biodataPdf'])->name('student.pdf.biodata');
        Route::get('/student/{student:nis}/mou-pdf', [StudentController::class, 'mouPdf'])->name('student.pdf.mou');
        Route::get('/student/{student:nis}/kts', [StudentController::class, 'kts'])->name('student.kts');
        Route::get('/student/{student:nis}/verify', [StudentController::class, 'verify'])->name('student.verify');
        Route::get('/student/{student:nis}/k-mahrom', [StudentController::class, 'kMahrom'])->name('student.k-mahrom');
        Route::get('/student/{student:nis}/mutation', [MutationController::class, 'mutation'])->name('student.mutation');

        Route::get('/approval/{category}', [ApprovalController::class, 'index'])->name('approval.index');
        Route::get('/approve/{id}/{category}', [ApprovalController::class, 'action'])->name('approval.action');

        Route::prefix('mutation')->group(function () {
            Route::get('/', [MutationController::class, 'index'])->name('mutation.index');
            Route::get('/history', [MutationController::class, 'index'])->name('mutation.history');
            Route::put('/{student:nis}/update', [MutationController::class, 'update'])->name('mutation.update');
            Route::put('/{student:nis}/drop_out', [MutationController::class, 'dropout'])->name('mutation.dropout');
        });

        Route::resource('announcement', AnnouncementController::class)->except('show');

        Route::prefix('setting')->group(function () {
            Route::get('admission', [AdmissionController::class,'index'])->name('admission.settings');
            Route::get('admission/{admission}/edit', [AdmissionController::class,'edit'])->name('admission.edit');
            Route::resource('admission', AdmissionController::class)->only('update','destroy','store');
            Route::resource('format-message', FormatMessageController::class);
        });

        Route::prefix('doc')->group(function () {
            Route::get('/generate/kts/{nis}/{action}', [DocumentController::class, 'kts'])->name('doc.generate.kts');
            Route::get('/generate/k_mahram/{nis}/{action}', [DocumentController::class, 'kartuMahram'])->name('doc.generate.k_mahram');
        });

        Route::resource('/setting', BakidSettingController::class);

        Route::resource('/room', RoomController::class);
        Route::get('/dormitory/room/{dormitory}', [DormitoryController::class, 'room'])->name('dormitory.room');
        Route::resource('/dormitory', DormitoryController::class);
        Route::name('formal.')->group(function () {  
            Route::resource('/formal/class', FormalEducationClassController::class);
        });
        Route::prefix('informal')->name('informal.')->group(function () {  
            Route::resource('/class', InformalEducationClassController::class);

            Route::get('/academic_years/activate/{academic_year}', [InformalEducationAcademicYearController::class, 'activate'])->name('academic_years.activate');
            Route::resource('/academic_years', InformalEducationAcademicYearController::class);
            Route::resource('/student', InformalEducationStudentController::class);
            Route::resource('/subject', InformalEducationSubjectController::class);
            Route::resource('/teacher', InformalEducationController::class);
        });
        Route::resource('/formal', FormalEducationController::class);
        Route::resource('/informal', InformalEducationController::class);
            
        Route::get('/payment/choose-method/{invoice_number}', [PaymentMethodController::class, 'chooseMethod'])->name('payment.choose-method');
        Route::post('/payment/change-method/', [PaymentMethodController::class, 'changeMethod'])->name('payment.change-method');

        Route::get('/invoice/categories', [InvoiceCategoryController::class, 'index'])->name('invoice.categories');
        Route::get('/invoice/category/{category:code}/edit', [InvoiceCategoryController::class, 'edit'])->name('invoice.category.edit');
        Route::get('/invoice/category/{category}/{isEdit?}', [InvoiceCategoryController::class, 'show'])->name('invoice.category.show');
        Route::put('/invoice/category/{category}', [InvoiceCategoryController::class, 'update'])->name('invoice.category.update');

        Route::get('/invoice/{categoryId}/discount/create', [InvoiceCategoryDiscountController::class, 'create'])->name('invoice.discount.create');
        Route::post('/invoice/{categoryId}/discount/store', [InvoiceCategoryDiscountController::class, 'store'])->name('invoice.discount.store');
        Route::get('/invoice/{discount}/discount/remove', [InvoiceCategoryDiscountController::class, 'remove'])->name('invoice.discount.remove');

        Route::get('/invoice/list', [InvoiceController::class, 'index'])->name('invoice.index');
        Route::post('/upload-proof', [InvoiceController::class, 'uploadProof'])->name('invoice.upload-proof');
        Route::get('/invoice/show/{invoice_number}', [InvoiceController::class, 'show'])->name('invoice.show');
        Route::post('/invoice/confirm', [InvoiceController::class, 'confirm'])->name('invoice.confirm');
        Route::get('/invoice/{invoice_number}/approve', [InvoiceController::class, 'approve'])->name('invoice.approve');

        Route::post('/reminder/store', [ReminderNotificationController::class, 'store'])->name('reminder.registration');

        Route::get('/change-background', [BakidSettingController::class, 'changeBackground'])->name('setting.change-bg');
        Route::get('/switch-locale', [BakidSettingController::class, 'switchLocale'])->name('setting.switch-locale');

        Route::resource('permittion', InOutPermissionController::class);
        Route::get('/izin', [InOutPermissionController::class, 'showAccess'])->name('permittion.access');
        Route::post('/in-out-permittion/store', [StudentInOutPermissionController::class, 'store'])->name('permittion.access.post');
        
        Route::resource('violation', ViolationController::class);
        Route::get('/export', [ExportController::class, 'index'])->name('export.index');
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