<?php

use App\Http\Controllers\ApprovalRequestController;
use App\Http\Controllers\ApprovalRequestTypeController;
use App\Http\Controllers\RequestApproverController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:api'])->group(function () {

    Route::get('/approval-request/sended', [ApprovalRequestController::class, 'getSendedApprovalRequest']);
    Route::get('/approval-request/received', [ApprovalRequestController::class, 'getReceivedApprovalRequest']);
    Route::get('/approval-request/all', [ApprovalRequestController::class, 'getAllApprovalRequest']);
    
    Route::resource('/approval-request', ApprovalRequestController::class);
    Route::resource('/request-approver', RequestApproverController::class);

    Route::resource('/approval-request-types', ApprovalRequestTypeController::class);
    Route::resource('/users', UserController::class);
    
});
