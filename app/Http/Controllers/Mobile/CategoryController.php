<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data=[
            'status'=> 'Success 200',
            'message'=> 'Get all categories',
            'categories' => ProductCategory::all(),
        ];
        return response($data);
    }
}
