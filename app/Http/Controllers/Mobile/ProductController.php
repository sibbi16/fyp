<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data=[
            'status'=> 'Success 200',
            'message'=> 'Get all Products',
            'products' => Products::all(),
        ];
        return response($data);
    }
    public function showProducts($id)
    {
        $data = [
            'status'=> 'Success 200',
            'message'=> 'Get all Products',
            'products' => Products::where('category_id','=',$id)->get(),
        ];
        return response($data);
    }
}
