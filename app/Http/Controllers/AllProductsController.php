<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AllProductsController extends Controller
{
    public function index()
    {
        $data =[
            'products'=>Products::latest()->get(),
        ];
        return view('dashboard.all_products.index', $data);
    }

    public function show(Products $product)
    {
        $data=[
            'product' => $product,
        ];
        return view('dashboard.all_products.show',$data);
    }

    public function edit(Products $product)
    {
        $data=[
            'product' => $product,
            'categories' => ProductCategory::get(),
        ];
        return view('dashboard.all_products.edit',$data);
    }

    public function update(Request $request , Products $product)
    {
        $request->validate([
            'name'=> ['required','string','max:255'],
            'description'=> ['required','string'],
            'category_id'=> ['required','integer'],
            'price'=> ['required','string','min:1'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png'],
        ]);

        if($request->hasFile('image')){
            $extension =$request->file('image')->extension();
            $name = $request->file('image')->getClientOriginalName();
            $file_path = $request->file('image')->store('product_images/',['disk'=>'public']);

            if($file_path){
                $product_image = [
                    'ext'=>$extension,
                    'name'=>$name,
                    'path'=>$file_path,
                ];
            }
        }
        $updated = $product->update([
            'category_id'=> $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description'=> $request->description,
            'price' => $request->price,
            'image'=> $product_image ?? $product->image,
        ]);

        if($updated){
            return redirect()->route('dashboard.all_products.index')->withSuccessMessage('Product Updated Successfully');
         }
         else{
             return redirect()->route('dashboard.all_products.index')->withErrorMessage('An Error Has Occured');;
         }
    }
    public function destroy(Products $product)
    {
        if($product){
            Storage::disk('public')->delete($product->image['path']);
            $delete = $product->delete();
        }
        if($delete){
            return redirect()->route('dashboard.all_products.index')->withSuccessMessage('Product Deleted Successfully');
         }
         else{
             return redirect()->route('dashboard.all_products.index')->withErrorMessage('An Error Has Occured');;
         }
    }
}
