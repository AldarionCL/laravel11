<?php


use App\Http\Livewire\Landbot\Chat;
use App\Http\Livewire\Landbot\ChatUsed;
use App\Http\Livewire\Landbot\Lead;
use App\Http\Livewire\Landbot\LeadUsed;

Route::get('/landbot/{chat}', Chat::class)->name('landbot')/*->middleware('permission:Lead vehiculos nuevos')*/;
Route::get('/lead', Lead::class)->name('lead')/*->middleware('permission:Lead nuevos interacción cliente')*/;

// Route lead used
Route::get('/landbot-used/{chat}', ChatUsed::class)->name('landbot.used')/*->middleware('permission:Lead vehiculos usados')*/;
Route::get('/lead-used', LeadUsed::class)->name('lead.used')/*->middleware('permission:Lead usados interacción cliente')*/;
