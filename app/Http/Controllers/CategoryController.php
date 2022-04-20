<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $data = [
            'categories' => ProductCategory::get(),
        ];
        return view('dashboard.categories.index',$data);
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> ['required','max:255','string'],
        ]);

        $category = ProductCategory::create([
            'user_id' => auth()->id(),
            'name' =>$request->name,
            'slug' => Str::slug($request->name),
        ]);

        if($category){
            return redirect()->route('dashboard.category.index')->withSuccessMessage('Category Created Succesfully');
        }else{
            return redirect()->route('dashboard.category.index')->withErrorMessage('An Error Occured');
        }
    }

    public function edit(ProductCategory $category)
    {
        $data=[
            'category' => $category,
        ];
        return view('dashboard.categories.edit',$data);
    }

    public function update(Request $request , ProductCategory $category)
    {
        $request->validate([
            'name' => ['required','string','max:255'],
        ]);
        if($category->id == 1){
            return redirect()->route('dashboard.category.index')->withWarningMessage('Cannot Edit This Category');
        }
        $updated = $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        if($updated){
            return redirect()->route('dashboard.category.index')->withSuccessMessage('Category Updated Succesfully');
        }else{
            return redirect()->route('dashboard.category.index')->withErrorMessage('An Error Occured');
        }
    }
}
