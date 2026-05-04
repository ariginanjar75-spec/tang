<?php

use App\Http\Controllers\DebtController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RepaymentController;

Route::get('/', [DebtController::class, 'index'])->name('debts.index');
Route::get('/debts/create', [DebtController::class, 'create'])->name('debts.create');
Route::post('/debts', [DebtController::class, 'store'])->name('debts.store');
Route::delete('/debts/{debt}', [DebtController::class, 'destroy'])->name('debts.destroy');
Route::put('/debts/{debt}', [DebtController::class, 'update'])->name('debts.update');
Route::post('/debts/{debt}/top-up', [DebtController::class, 'topUp'])->name('debts.topUp');
Route::post('/debts/{debt}/repayments', [RepaymentController::class, 'store'])->name('repayments.store');
Route::put('/repayments/{repayment}', [RepaymentController::class, 'update'])->name('repayments.update');
Route::delete('/repayments/{repayment}', [RepaymentController::class, 'destroy'])->name('repayments.destroy');
