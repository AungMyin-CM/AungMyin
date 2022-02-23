<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\LoginController;


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

Route::get('/', function () {
    return view('login.login');
});

Route::get('clinic-name', function () {
    return view('registration.clinic_name');
})->name('clinic-name');

Route::get('register-clinic', function () {
    return view('registration.clinic_registration');
})->name('register-clinic');

Route::post('register-clinic',[ClinicController::class, 'register'])->name('clinic.register');

Route::post('login',[LoginController::class, 'login'])->name('login');