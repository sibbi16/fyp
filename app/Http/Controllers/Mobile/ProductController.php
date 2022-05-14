<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data=[
            'status'=> 'Success 200',
            'message'=> 'Get all Products',
            'categories' => Products::all(),
        ];
        return response($data);
    }
}
