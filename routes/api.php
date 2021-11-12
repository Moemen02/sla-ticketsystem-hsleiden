<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContractController;

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
    Route::get('/users', [UserController::class, 'getAllUsers']);
    Route::get('/admins', [UserController::class, 'getAllAdmins']);
    Route::post('/user', [UserController::class, 'registerUser']);
    Route::get('/user/{id}', [UserController::class, 'getSelectedUser']);
    Route::get('/employees/{companyID}', [UserController::class, 'getEmployees']);
    Route::delete('/user/{user}', [UserController::class, 'deleteUser']);
    Route::put('/user/{user}', [UserController::class, 'updateUser']);
    
    // ticket routes
    Route::post('/ticket', [TicketController::class, 'createTicket']);
    Route::get('/ticket', [TicketController::class, 'getTickets']);
    Route::get('/ticket/{user}', [TicketController::class, 'getUserTickets']);
    Route::get('/tickets/{companyID}', [TicketController::class, 'getCompanyTickets']);
    
    // Company routes
    Route::post('/company', [CompanyController::class, 'createCompany']);
    Route::get('/company', [CompanyController::class, 'getCompanies']);
    Route::get('/company/{id}', [CompanyController::class, 'getUserCompany']);

    // Contract routes
    Route::post('/contract', [ContractController::class, 'makeContract']);
    Route::get('/contract', [ContractController::class, 'getContracts']);
    Route::get('/contract/{id}', [ContractController::class, 'currentContract']);
    Route::put('/contract/{contract}', [ContractController::class, 'updateContract']);
    Route::delete('/contract/{contract}', [ContractController::class, 'deleteContract']);

});
