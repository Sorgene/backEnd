<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductTypesController extends Controller
{
    public function index()
    {
        return view('admin/productTypes/index');
    }

}