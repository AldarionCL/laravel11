<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperationController extends Controller
{
    public function index()
    {
        return view('livewire.operation.page.page-operation-ticket');
    }
}
