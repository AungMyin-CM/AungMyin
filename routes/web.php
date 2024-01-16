<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\FeedBackController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\InvestigationController;

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

Route::get('/login', [LoginController::class, 'index'])->name('user-login')->middleware('guest');

Route::post('/send-otp', [UserController::class, 'sendOtp'])->name('send-otp')->middleware('guest');

Route::get('/.well-known/acme-challenge/4xLMh6F-_UUkepftHZWPtrTuEhZZ2VV8a9_mDc7IMiw',function(){

  return '4xLMh6F-_UUkepftHZWPtrTuEhZZ2VV8a9_mDc7IMiw.JhL8guqbYpyNxPARURqNLP7XLEFCKNsU5gbCSFebTZQ';

});
// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgetPassword'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'submitForgetPassword'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{email}/{token}', [ForgotPasswordController::class, 'showResetPassword'])
    ->middleware('guest')
    ->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPassword'])->middleware('guest')->name('password.update');

Route::get('/', [HomeController::class, 'welcome'])->name('aung-myin.welcome');

Route::get('package-selection', [ClinicController::class, 'stepOneRegister'])->name('package.selection')->middleware('auth');

Route::get('clinic-info', [ClinicController::class, 'stepTwoRegister'])->name('clinic.info')->middleware('auth');
Route::get('payment', [ClinicController::class, 'payment'])->name('payment')->middleware('auth');

Route::post('register-clinic', [ClinicController::class, 'register'])->name('clinic.register')->middleware('auth');

Route::post('/contact', [ContactController::class, 'store'])->name('contact-us');

// Route::get('/email-view',function() {
//     return view('email-template');
// });

Route::get('/email-view', [UserController::class, 'showMailTemp'])->name('contact-us');


Route::get('clinic-login', function () {
    return view('login.clinic');
})->name('login-clinic')->middleware('prevent-back-history');

Route::get('home', [HomeController::class, 'index'])->name('user.home')->middleware('auth');

Route::group(['prefix' => '/clinic-system', 'middleware' => ['auth']], function () {

    Route::post('userlogout', [LoginController::class, 'logout'])->name('user.logout');

    Route::resource('dictionary', DictionaryController::class);

    Route::resource('procedure', ProcedureController::class);

    Route::resource('investigation', InvestigationController::class);

    Route::resource('patient', PatientController::class);

    Route::get('/patient/show', [PatientController::class, 'show'])->name('patient.show');

    Route::resource('pharmacy', PharmacyController::class);

    Route::get('fetchData', [PatientController::class, 'fetchProcedureLabData'])->name('fetch.data');

    Route::post('patient-add', [PatientController::class, 'storePatient'])->name('patient.storePatient');

    Route::patch('patient-update/{patient}', [PatientController::class, 'updatePatient'])->name('patient.updatePatient');

    Route::get('patient/{patient}/treatment', [PatientController::class, 'treatment'])->name('patient.treatment');

    Route::post('patient/{patient}/treatment', [PatientController::class, 'saveTreatment'])->name('create.treatment');

    Route::post('patient/{patient}/lab', [PatientController::class, 'saveProLabData'])->name('save.prolab');

    Route::post('/fetchDiagnosis', [PatientController::class, 'fetchDiagnosis'])->name('get.diagnosis');

    Route::post('/fetchDisease', [PatientController::class, 'fetchDisease'])->name('get.disease');

    Route::post('/fetchDictionary', [PatientController::class, 'fetchDictionary'])->name('dictionary.get');

    Route::post('/fetchIsmed', [PatientController::class, 'fetchIsmedData']);

    Route::post('/fetchProLab', [PatientController::class, 'fetchProLab']);

    Route::get('/search', [SearchController::class, 'searchPatient']);
    Route::post('/second_search', [SearchController::class, 'secondsearchPatient']);


    Route::post('/searchMed', [SearchController::class, 'searchMedicine']);

    Route::post('/searchMedPatient', [SearchController::class, 'searchMedPatient']);

    Route::post('/updateStatus', [PatientController::class, 'updatePatientStatus']);

    Route::get('/addQueue/{id}', [PatientController::class, 'addQueue'])->name('add.queue');

    Route::resource('/pos', PosController::class);

    Route::get('/pos-history', [PosController::class, 'history'])->name('pos.history');

    Route::get('/pos-patient/{patient_id}', [PosController::class, 'patientPos'])->name('pos-patient');

    Route::get('/pos-print/{id}', [PosController::class, 'printInvoice'])->name('pos-invoice');

    Route::post('/medData', [PosController::class, 'getMedData']);

    Route::get('users', [UserController::class, 'userList'])->name('user.list');

    Route::post('clinic/{id}', [ClinicController::class, 'updateClinic'])->name('clinic.update');

    Route::get('/clinic/logo/{clinicId}', [ClinicController::class, 'getLogo'])->name('clinic.logo');

    Route::get('user/create', [ClinicController::class, 'newUser'])->name('user.create');

    Route::get('user/{user}', [ClinicController::class, 'editUser'])->name('user.edit');

    Route::post('user/{user}', [ClinicController::class, 'updateUser'])->name('user.update');

    Route::post('user-delete/{user}', [ClinicController::class, 'deleteUser'])->name('user.destroy');

    Route::post('register-user', [ClinicController::class, 'registerUser'])->name('clinic-user.register');

    Route::post('change-status', [NotificationController::class, 'readStatus']);

    Route::post('copy-data', [PatientController::class, 'copyTreatment']);

    Route::post('remove-data', [PatientController::class, 'removeTreatment']);

    Route::get('/summary', [PosController::class, 'summary'])->name('summary');

    Route::get('check-noti', [NotificationController::class, 'getNoti']);

    Route::get('settings/{id}', [UserController::class, 'updateProfile'])->name('clinic.settings');

    Route::post('setting-save/{id}', [UserController::class, 'saveProfile'])->name('settings.save');

    Route::post('pharma_code/check', [PharmacyController::class, 'checkMedCode'])->name('pharma_code.check');

    Route::get('getDoctors', [ClinicController::class, 'fetchDoctors'])->name('get.doctors');

    Route::get('/exportPatient', [DataController::class, 'exportPatient'])->name('exportPatient');
    Route::get('/exportMedCSV', [DataController::class, 'exportMedCSV'])->name('exportPharmacy');

    Route::post('/importExcelPatient', [DataController::class, 'importPatientExcel'])->name('patient.excel.import');
    Route::post('/importExcelPharmacy', [DataController::class, 'importPharmacyExcel'])->name('pharmacy.excel.import');

    // dictionary import/export
    Route::get('/exportDictionaryCSV',[DataController::class,'exportDictionaryCSV']);
    Route::post('/importExcelDictionary',[DataController::class,'importDictionaryExcel'])->name('dictionary.excel.import');

    Route::post('/pharmacyImport', [PharmacyController::class, 'pharmacyImport'])->name('pharmacy.import');
    Route::post('/patientImport', [PatientController::class, 'patientImport'])->name('patient.import');

    Route::get('/complete-payment/{id}', [ClinicController::class, 'completePayment'])->name('complete.payment');

    Route::get('/dinger-complete', [ClinicController::class, 'completeDingerPayment'])->name('dinger.complete');
});

Route::group(['prefix' => '/aungmyin/dashboard', 'middleware' => ['auth', 'isAdmin']], function () {

    Route::post('login', [LoginController::class, 'login'])->name('login');
});

Route::post('logout', [LoginController::class, 'clinicLogout'])->name('clinic.logout');

Route::post('login', [LoginController::class, 'login'])->name('login');

Route::get('register', [UserController::class, 'index'])->name('register.user')->middleware('guest');

Route::post('email_available/check', [UserController::class, 'checkEmail'])->name('email_available.check');

Route::post('username_available/check', [UserController::class, 'checkUsername'])->name('username_available.check');

Route::post('user-register', [UserController::class, 'register'])->name('user.register');

Route::get('/verify', [UserController::class, 'verify'])->name('verify');

Route::post('/checkOtp', [UserController::class, 'checkOtp'])->name('verify-otp');

Route::post('/feedback-store', [FeedBackController::class, 'store'])->name('feedback.store');

Route::get('/waiting', [ClinicController::class, 'waitingList'])->name('wait.list');

Route::get('/documentation', [DocController::class, 'index'])->name('docs.index');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/clinic-system/{code}', [ClinicController::class, 'index'])->name('user.clinic');

    Route::get('dashboard', [ClinicController::class, 'dashboard'])->name('clinic.home');
});

// Super Admin Routes
Route::prefix('aung_myin/admin_dashboard')->group(function () {
    Route::get('/login', [SuperAdminController::class, 'login']);
    Route::post('/login', [SuperAdminController::class, 'authenticate'])->name('superadmin.login');

    Route::middleware(['superAuth'])->group(function () {
        // Home route
        Route::get('/', [SuperAdminController::class, 'index'])->name('superadmin.index');

        // User route
        Route::get('/users', [SuperAdminController::class, 'users'])->name('superadmin.users');
        Route::get('/users?type={type}', [SuperAdminController::class, 'users'])->name('superadmin.filter');
        Route::get('/users/{id}', [SuperAdminController::class, 'edit'])->name('superadmin.edit');
        Route::patch('/users/{id}', [SuperAdminController::class, 'update'])->name('superadmin.update');

        // Clinic route
        Route::get('/clinics', [SuperAdminController::class, 'clinics'])->name('superadmin.clinics');
        Route::get('/clinics/{id}', [SuperAdminController::class, 'clinicEdit'])->name('superadmin.clinicEdit');
        Route::patch('/clinics/{id}', [SuperAdminController::class, 'clinicUpdate'])->name('superadmin.clinicUpdate');

        // Patient route
        Route::get('/patients', [SuperAdminController::class, 'patients'])->name('superadmin.patients');

        // Package route
        Route::resource('/package', PackageController::class);

        // Feedback route
        Route::get('/feedback', [SuperAdminController::class, 'feedback'])->name('superadmin.feedback');
        Route::get('/feedback/{id}', [SuperAdminController::class, 'show'])->name('superadmin.showFeedback');
        Route::get('/feedback/reply/{id}', [SuperAdminController::class, 'reply'])->name('superadmin.replyFeedback');
        Route::post('/feedback', [SuperAdminController::class, 'sendFeedbackEmail'])->name('superadmin.sendFeedbackEmail');

        // Profile Setting
        Route::get('/profile', [SuperAdminController::class, 'profile'])->name('superadmin.profile');
        Route::patch('/profile/{id}', [SuperAdminController::class, 'profileUpdate'])->name('superadmin.profileUpdate');

        // Logout
        Route::post('/logout', [SuperAdminController::class, 'logout'])->name('superadmin.logout');
    });
});
