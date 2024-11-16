<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('api-test', [HomeController::class, "apiTest"])->name('user.maintenance.api-test');
Route::post('api-create', [HomeController::class, "apiCreate"])->name('user.maintenance.api-create');
