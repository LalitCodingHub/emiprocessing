<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanDetailsController;
use App\Http\Controllers\LoanEMIController;

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
    return view('welcome');
});

// Auth::routes();
Auth::routes([
    'register' => false,  // Disable registration route
    'reset' => false,     // Disable password reset routes
    'verify' => false,    // Disable email verification routes
    'confirm' => false,   // Disable password confirmation routes
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::redirect('/home', '/loan-details');

Route::middleware(['auth'])->group(function () {
    Route::get('/loan-details', [LoanDetailsController::class, 'index'])->name('loan.details');
    Route::get('/process-data', [LoanEMIController::class, 'showForm'])->name('process.data.page');
    Route::post('/process-data', [LoanEMIController::class, 'processData'])->name('process.data');
});