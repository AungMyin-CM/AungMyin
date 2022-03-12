<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\PatientController;



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

Route::get('clinic-name', function () {
    return view('registration.clinic_name');    
})->name('clinic-name');

Route::get('register-clinic', function () {
    return view('registration.clinic_registration');
})->name('register-clinic');

Route::get('clinic-login', function () {
    return view('login.clinic');
})->name('login-clinic');

Route::post('register-clinic',[ClinicController::class, 'register'])->name('clinic.register');

Route::group(['middleware' => 'auth'], function () {

    Route::resource('dictionary',DictionaryController::class);

    Route::get('home', function () {
        return view('clinic.home');
    })->name('user.home');

    Route::post('userlogout', [LoginController::class, 'userLogout'])->name('user.logout');

    Route::resource('patient',PatientController::class);

    Route::post('/fetchDictionary',[PatientController::class, 'fetchDictionary'])->name('dictionary.get');

});


Route::post('logout', [LoginController::class, 'clinicLogout'])->name('clinic.logout');

Route::group(['middleware' => 'prevent-back-history'],function(){
    
    Route::post('clinic-login',[LoginController::class, 'clinicLogin'])->name('clinic.login');

    Route::post('user-login',[LoginController::class, 'userLogin'])->name('user.login');

});

Route::group(['middleware' => 'clinic.auth'], function() {

    Route::get('users',[ClinicController::class,'index'])->name('user.list');

    Route::get('user/create',[ClinicController::class,'newUser'])->name('user.create');

    Route::post('register-user',[ClinicController::class, 'registerUser'])->name('user.register');

    Route::get('dashboard', function () {
        return view('clinic.dashboard');
    })->name('clinic.home');


});