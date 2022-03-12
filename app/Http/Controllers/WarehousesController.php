<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Warehouses;

class WarehousesController extends Controller
{
    public function index()
    {
        $data=[
            'warehouses'=> Warehouses::all(),
        ];
        return view('dashboard.warehouses.index',$data);
    }

    public function create()
    {
        return view('dashboard.warehouses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'warehouse_name'=>['required','string','max:255'],
            'warehouse_address' =>['required','string'],
            'warehouse_phone' => ['required','string','max:255'],
            'warehouse_image' =>['nullable','image', 'mimes:jpeg,png.jpg'],
        ]);

        if($request->hasFile('warehouse_image')){
            $extension =$request->file('warehouse_image')->extension();
            $name = $request->file('warehouse_image')->getClientOriginalName();
            $file_path = $request->file('warehouse_image')->store('warehouse_images/',['disk'=>'public']);

            if($file_path){
                $warehouse_image = [
                    'ext'=>$extension,
                    'name'=>$name,
                    'path'=>$file_path,
                ];
            }
        }
        $warehouse_id = Helper::IDGenerator(new Warehouses, 'warehouse_id', 4, 'W'); /** Generate id */

        $warehouse = Warehouses::create([
            'warehouse_id'=>$warehouse_id,
            'company_id'=>auth()->user()->id,
            'warehouse_name'=> $request->warehouse_name,
            'warehouse_address'=>$request->warehouse_address,
            'warehouse_phone' => $request->warehouse_phone,
            'warehouse_image' =>$warehouse_image ?? null,
        ]);
        if($warehouse){
            return redirect()->route('dashboard.warehouses.index')->withSuccessMessage('Warehouse created successfully');
        }else{
            return redirect()->route('dashboard.warehouses.index')->withErrorMessage('An Error Occured');
        }
    }
}
