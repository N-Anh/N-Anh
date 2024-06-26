<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\Controller;

Route::get('/', [ContractController::class, 'chart'])->name('contracts.chart');
Route::resource('/contracts', ContractController::class);
Route::post('/contracts/{id}/terminate', [ContractController::class, 'terminate'])->name('contracts.terminate');
Route::post('/contracts/{id}', [ContractController::class, 'renew'])->name('contracts.renew');

// Route::get('/export-employees-without-contracts', [Controller::class, 'exportEmployeesWithoutContracts']);
// Route::get('/testMail', [ContractController::class, 'sendContractExpiryNotification']);


