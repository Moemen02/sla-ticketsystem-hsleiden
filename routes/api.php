<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;

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

// Authentication routes
Route::post('/user/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    
    // Auth
    Route::delete('/logout/{user}', [AuthController::class, 'logout']);

    // user routes
    Route::get('/user', [UserController::class, 'getCurrentUser']);

    // ticket routes
    Route::post('/ticket', [TicketController::class, 'createTicket']);
    

});
