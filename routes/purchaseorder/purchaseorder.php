<?php

use App\Http\Controllers\ExportDataController;
use App\Http\Controllers\FormReceptionOc;
use App\Http\Livewire\Oc\DataPurchaseOrder;
use App\Http\Livewire\Oc\DetailPurchaseOrder;
use App\Http\Livewire\Oc\DetailReception;
use App\Http\Livewire\Oc\FormPurchaseOrder;
use App\Http\Livewire\Oc\ListOcCPD;
use App\Http\Livewire\Oc\ListOrderRequestApproved;
use App\Http\Livewire\Oc\ListPrePurchaseOrderProvider;
use App\Http\Livewire\Oc\ListProviders;
use App\Http\Livewire\Oc\OcListToReceive;
use App\Http\Livewire\Oc\OcOrderRequestApprovedTable;
use App\Http\Livewire\Oc\ProviderDetail;
use App\Http\Livewire\Oc\ProviderEdit;
use App\Http\Livewire\Oc\ProviderOc;
use App\Http\Livewire\Oc\PurchaseOrderList;
use App\Http\Livewire\Oc\ReceptionFormOc;
use App\Http\Livewire\Oc\ReceptionList;

Route::get('/orden-de-compra',  FormPurchaseOrder::class )->name('purchase-order')/*->middleware('permission:Crear OC')*/;
Route::get('/listado-ordenes-de-compra',  PurchaseOrderList::class )->name('purchase.order.list')/*->middleware('permission:Editar OC')*/;
Route::get('/detalle-orden-de-compra/{ocPurchaseOrder}',  DetailPurchaseOrder::class )->name('purchase.order.show')/*->middleware('permission:Editar OC')*/;
Route::get('/proveedores',  ProviderOc::class )->name('purchase.order.provider')/*->middleware('permission:Crear Proveedores')*/;
Route::get('/lista-proveedores',  ListProviders::class )->name('purchase.order.provider-list')/*->middleware('permission:Ver Proveedores')*/;
Route::get('/detalle-proveedor/{provider}',  ProviderDetail::class )->name('provider.show')/*->middleware('permission:Ver Proveedores')*/;
Route::get('/edicion-proveedor/{provider}',  ProviderEdit::class )->name('provider.edit')/*->middleware('permission:Editar Proveedores')*/;
//Route::get('/recepcion-orden-de-compra/{ocPurchaseOrder}',  ReceptionFormOc::class )->name('reception.purchaseorder');
Route::get('/recepcion-orden-de-compra-controller/{ocPurchaseOrder}', [ FormReceptionOc::class, 'show' ])->name('reception.purchaseorder.create')/*->middleware('permission:Recepción OC')*/;
Route::post('/recepcion-orden-de-compra-controller', [ FormReceptionOc::class, 'store' ])->name('reception.purchaseorder.store')/*->middleware('permission:Recepción OC')*/;
Route::get('/lista-solicitud-de-pedidos-aprovadas', ListOrderRequestApproved::class)->name('order.request.list.aprroved')/*->middleware('permission:Crear OC')*/;
Route::get( '/listado-de-recepciones', ReceptionList::class)->name('reception.list');
Route::get( '/detalle-de-recepciones/{reception}', DetailReception::class)->name('detail.reception');
Route::get( '/ordenes-de-compra-por-recepcionar', OcListToReceive::class)->name('purchaseorder.list.to.receive');

// List Pre OC Providers
Route::get('/lista-pre-ordenes-de-compra-proveedores', ListPrePurchaseOrderProvider::class)->name('list.pre.purchase.order.provider')/*->middleware('permission:Crear OC desde Proveedores')*/;

// Excel purchase order data
Route::get('/data-ordenes-de-compra', DataPurchaseOrder::class )->name('export.purchase.order');

Route::get('/ocPDF/{ocPurchaseOrder}', [ FormReceptionOc::class, 'createPDF'])->name('create.pdf');
//Route::get('listado-de-ordenes-de-compra-cpd', ListOcCPD::class)->name('purchase.order.list.cpd');
