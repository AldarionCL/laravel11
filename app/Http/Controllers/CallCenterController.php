<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CallCenterController extends Controller
{
    public function index()
    {
        return view('livewire.call-center.page.page-call-center-ticket');
    }
}
