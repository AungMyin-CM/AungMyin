<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PharmacyController;


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

Route::get('clinic-name',[ClinicController::class, 'stepOneRegister'])->name('clinic.name');

Route::get('clinic-info',[ClinicController::class, 'stepTwoRegister'])->name('clinic.info');

Route::get('clinic-login', function () {
    return view('login.clinic');
})->name('login-clinic')->middleware('prevent-back-history');

Route::post('register-clinic',[ClinicController::class, 'register'])->name('clinic.register');

Route::group(['middleware' => 'auth'], function () {

    Route::resource('dictionary',DictionaryController::class);

    Route::get('home', [HomeController::class, 'index'])->name('user.home');

    Route::post('userlogout', [LoginController::class, 'userLogout'])->name('user.logout');

    Route::resource('patient',PatientController::class);

    Route::resource('pharmacy',PharmacyController::class);

    Route::get('patient/{patient}/treatment',[PatientController::class, 'treatment'])->name('patient.treatment');

    Route::post('patient/{patient}/treatment',[PatientController::class, 'saveTreatment'])->name('create.treatment');

    Route::post('/fetchDictionary',[PatientController::class, 'fetchDictionary'])->name('dictionary.get');

    Route::post('/search',[PatientController::class, 'searchPatient']);

    Route::post('/updateStatus',[PatientController::class, 'updatePatientStatus']);


});


Route::post('logout', [LoginController::class, 'clinicLogout'])->name('clinic.logout');

Route::post('clinic-login',[LoginController::class, 'clinicLogin'])->name('clinic.login');

Route::post('user-login',[LoginController::class, 'userLogin'])->name('user.login');

Route::group(['middleware' => 'clinic.auth'], function() {

    Route::get('users',[ClinicController::class,'index'])->name('user.list');

    Route::get('user/create',[ClinicController::class,'newUser'])->name('user.create');

    Route::get('user/{user}',[ClinicController::class,'editUser'])->name('user.edit');

    Route::post('user/{user}',[ClinicController::class,'updateUser'])->name('user.update');

    Route::post('register-user',[ClinicController::class, 'registerUser'])->name('user.register');

    Route::get('dashboard', function () {
        return view('clinic.dashboard');
    })->name('clinic.home');


});