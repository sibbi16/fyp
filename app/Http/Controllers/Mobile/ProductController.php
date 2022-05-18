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
    public function showProducts(ProductCategory $category)
    {
        return response($category);
        $category = ProductCategory::where('id',$id)->get();
        return response($category);
        // $products = Products::where('category_id','=',$id)->get();

        if($category === null){
            $data['status'] = "Error 404";
            $data['message'] = "Could not find products";
        }else{

        }
        $data = [
            'status'=> 'Success 200',
            'message'=> 'Get all Products',
            'products' => Products::where('category_id','=',$id)->get(),
        ];
        return response($data);
    }
}
