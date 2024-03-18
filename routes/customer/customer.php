<?php

use App\Http\Livewire\Customer\Customer ;
use App\Http\Livewire\Customer\CustomerDetail;
use App\Http\Livewire\Customer\CustomerEdit;

Route::get('/clientes', Customer::class)->name('customers');
Route::get('/cliente/{id}', CustomerDetail::class)->name('customer.show');
Route::get('/cliente-editar/{customer}', CustomerEdit::class)->name('customer.edit');
