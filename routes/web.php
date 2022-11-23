<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\FeedBackController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;

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

Route::get('/', [LoginController::class, 'index'])->name('user-login')->middleware('guest');

Route::get('package-selection',[ClinicController::class, 'stepOneRegister'])->name('package.selection')->middleware('auth');

Route::get('clinic-info',[ClinicController::class, 'stepTwoRegister'])->name('clinic.info')->middleware('auth');
Route::get('payment',[ClinicController::class, 'payment'])->name('payment')->middleware('auth');

Route::post('register-clinic',[ClinicController::class, 'register'])->name('clinic.register')->middleware('auth');


Route::get('clinic-login', function () {
    return view('login.clinic');
})->name('login-clinic')->middleware('prevent-back-history');

Route::get('home', [HomeController::class, 'index'])->name('user.home')->middleware('auth');

Route::group(['prefix' => '/clinic-system', 'middleware' => ['auth']], function(){

    Route::post('userlogout', [LoginController::class, 'logout'])->name('user.logout');

    Route::resource('dictionary',DictionaryController::class);

    Route::resource('patient',PatientController::class);

    Route::resource('pharmacy',PharmacyController::class);

    Route::get('patient/{patient}/treatment',[PatientController::class, 'treatment'])->name('patient.treatment');

    Route::post('patient/{patient}/treatment',[PatientController::class, 'saveTreatment'])->name('create.treatment');

    Route::post('/fetchDictionary',[PatientController::class, 'fetchDictionary'])->name('dictionary.get');

    Route::post('/fetchIsmed',[PatientController::class, 'fetchIsmedData']);

    Route::post('/search',[SearchController::class, 'searchPatient']);

    Route::post('/searchMed',[SearchController::class, 'searchMedicine']);

    Route::post('/searchMedPatient',[SearchController::class, 'searchMedPatient']);

    Route::post('/updateStatus',[PatientController::class, 'updatePatientStatus']);

    Route::get('/addQueue/{id}',[PatientController::class, 'addQueue'])->name('add.queue');

    Route::resource('/pos',PosController::class);

    Route::get('/pos-history',[PosController::class, 'history'])->name('pos.history');

    Route::get('/pos-patient/{patient_id}',[PosController::class, 'index'])->name('pos-patient');

    Route::post('/medData',[PosController::class, 'getMedData']);

    Route::get('users',[UserController::class,'userList'])->name('user.list');

    Route::get('user/create',[ClinicController::class,'newUser'])->name('user.create');

    Route::get('user/{user}',[ClinicController::class,'editUser'])->name('user.edit');

    Route::post('user/{user}',[ClinicController::class,'updateUser'])->name('user.update');

    Route::post('user-delete/{user}',[ClinicController::class,'deleteUser'])->name('user.destroy');

    Route::post('register-user',[ClinicController::class, 'registerUser'])->name('clinic-user.register');

    Route::post('change-status',[NotificationController::class, 'readStatus']);

    Route::post('copy-data',[PatientController::class,'copyTreatment']);

    Route::post('remove-data',[PatientController::class,'removeTreatment']);

    Route::get('/summary',[PosController::class,'summary'])->name('summary');

    Route::get('check-noti',[NotificationController::class, 'getNoti']);

    Route::get('settings',[ClinicController::class, 'settings'])->name('clinic.settings');

    Route::post('pharma_code/check',[PharmacyController::class, 'checkMedCode'])->name('pharma_code.check');

    Route::get('getDoctors',[ClinicController::class,'fetchDoctors'])->name('get.doctors');
    
});

Route::group(['prefix' => '/aungmyin/dashboard', 'middleware' => ['auth','isAdmin']], function(){

    Route::post('login',[LoginController::class, 'login'])->name('login');


});

Route::post('logout', [LoginController::class, 'clinicLogout'])->name('clinic.logout');

Route::post('login',[LoginController::class, 'login'])->name('login');

Route::get('register',[UserController::class, 'index'])->name('register.user');

Route::post('email_available/check',[UserController::class, 'checkEmail'])->name('email_available.check');

Route::post('username_available/check',[UserController::class, 'checkUsername'])->name('username_available.check');

Route::post('user-register',[UserController::class, 'register'])->name('user.register');

Route::get('/verify', [UserController::class, 'verify'])->name('verify');

Route::post('/feedback-store',[FeedBackController::class, 'store'])->name('feedback.store');

Route::get('/feedback',[FeedBackController::class, 'create'])->name('feedback.create');

Route::group(['middleware' => 'auth'], function() {

    Route::get('/clinic-system/{code}',[ClinicController::class, 'index'])->name('user.clinic');

    Route::get('dashboard',[ClinicController::class, 'dashboard'])->name('clinic.home');
    
});