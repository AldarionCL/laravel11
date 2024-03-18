<?php

use App\Http\Controllers\ExportDataController;
use App\Http\Controllers\PurchaseRequestController;
use App\Http\Livewire\Oc\DataOrderRequest;
use App\Http\Livewire\Oc\DetailOrderRequest;
use App\Http\Livewire\Oc\FormEditProductOc;
use App\Http\Livewire\Oc\FormRegisterProductOc;
use App\Http\Livewire\Oc\ItemsInStock;
use App\Http\Livewire\Oc\ListOrderRequest;
use App\Http\Livewire\Oc\OcConfig;
use App\Http\Livewire\Oc\PriceAssignmentList;
use App\Http\Livewire\Oc\PricesOrderRequest;

Route::get('/solicitud', [ PurchaseRequestController::class, 'create'])->name('order.request')/*->middleware('permission:Crear SP')*/;
Route::get('/listado-solicitud-de-pedidos', ListOrderRequest::class)->name('order.request.list')/*->middleware('permission:Editar SP')*/;
Route::get('/detalle-solicitud-de-pedidos/{ocOrderRequest}', DetailOrderRequest::class)->name('order.request.show')/*->middleware('permission:Editar SP')*/;
Route::get('/sol-configuracion', OcConfig::class)->name( 'purchaseorder.form.category.subcategory')/*->middleware('permission:Crear SP')*/;
Route::get('/mantenedor-de-productos', FormRegisterProductOc::class)->name('purchaseorder.form.create.product')/*->middleware('permission:Crear y Editar Articulos')*/;
Route::get('/listado-asignacion-de-precios', PriceAssignmentList::class)->name('purchaseorder.prices.assignment.list')/*->middleware('permission:Asignación de Precios')*/;
Route::get( '/asignacion-precios-solped/{ocOrderRequest}', PricesOrderRequest::class )->name( 'request-order-prices' )/*->middleware('permission:Asignación de Precios')*/;
Route::get( '/articulos-con-stock', ItemsInStock::class )->name( 'items.in.stock' );

// Form edit articles
Route::get('/formulario-edicion-de-productos/{ocProduct}', FormEditProductOc::class )->name('purchaseorder.form.edit.product')/*->middleware('permission:Crear y Editar Articulos')*/;

// Excel order request data
Route::get('/data-solicitud-de-pedidos', DataOrderRequest::class )->name('export.order.request');
