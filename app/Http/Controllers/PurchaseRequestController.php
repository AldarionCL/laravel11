<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseRequestController extends Controller
{
    public function create()
    {
        return view('purchase-request.page-purchase-request');
    }
}
