<?php

namespace App\Http\Controllers;
use App\Models\ProductCategory;
use App\Models\Products;
use App\Models\Warehouses;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function index(Warehouses $warehouse)
    {
        $data=[
            'warehouse' => $warehouse,
            'products' => Products::where('warehouse_id' , $warehouse->id)->get(),
        ];
        return view('dashboard.warehouses.products.index',$data);
    }

    public function create(Warehouses $warehouse)
    {
        $data=[
            'warehouse' => $warehouse,
            'categories' => ProductCategory::get(),
        ];
        return view('dashboard.warehouses.products.create',$data);
    }

    public function show(Products $product , Warehouses $warehouse)
    {
        $data=[
            'product' => $product,
            'warehouse' => $warehouse,
        ];
        return view('dashboard.warehouses.products.show' , $data);
    }

    public function store (Request $request)
    {
        $request->validate([
            'name'=> ['required','string','max:255'],
            'description'=> ['required','string'],
            'category_id'=> ['required','integer'],
            'price'=> ['required','string','min:1'],
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png'],
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
        $product = Products::create([
            'warehouse_id' => $request->warehouse_id,
            'category_id'=> $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description'=> $request->description,
            'price' => $request->price,
            'image'=> $product_image,
        ]);

        if($product){
            return redirect()->route('dashboard.warehouses.products.index',$request->warehouse_id)->withSuccessMessage('Product Created Successfully');
         }
         else{
             return redirect()->route('dashboard.warehouses.products.index',$request->warehouse_id)->withErrorMessage('An Error Has Occured');;
         }
    }

    public function edit(Products $product, Warehouses $warehouse)
    {
        $data=[
            'product' => $product,
            'warehouse' => $warehouse,
            'categories' => ProductCategory::get(),
        ];
        return view('dashboard.warehouses.products.edit',$data);
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
            return redirect()->route('dashboard.warehouses.products.index',$request->warehouse_id)->withSuccessMessage('Product Updated Successfully');
         }
         else{
             return redirect()->route('dashboard.warehouses.products.index',$request->warehouse_id)->withErrorMessage('An Error Has Occured');;
         }
    }

    public function destroy(Products $product , Warehouses $warehouse)
    {
        if($product){
            Storage::disk('public')->delete($product->image['path']);
            $delete = $product->delete();
        }
        if($delete){
            return redirect()->route('dashboard.warehouses.products.index',$warehouse->id)->withSuccessMessage('Product Deleted Successfully');
         }
         else{
             return redirect()->route('dashboard.warehouses.products.index',$warehouse->id)->withErrorMessage('An Error Has Occured');;
         }
    }
}
