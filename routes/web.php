<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\DetractionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('bills', BillController::class)->names('bills');

Route::resource('detractions', DetractionController::class)->names('detractions');

Route::resource('deposits', DepositController::class)->names('deposits');
