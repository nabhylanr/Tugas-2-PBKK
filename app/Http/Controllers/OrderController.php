<?php

namespace App\Http\Controllers;

use App\Models\Kategori; 
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {        
        return view('order.index');
    }
}
