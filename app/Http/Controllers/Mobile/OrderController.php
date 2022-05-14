<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Dotenv\Repository\RepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $data =[
            'orders' => Orders::all(),
        ];
        return view('dashboard.orders.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> ['required','max:255','string'],
            'price'=> ['required','string'],
            'quantity'=> ['required','string'],
            'total'=> ['required','string'],
            'image'=> ['required','mimes:png,jpg,jpeg'],
            'status' => ['nullable'],
        ]);

        if($request->hasFile('image')){
            $extension =$request->file('image')->extension();
            $name = $request->file('image')->getClientOriginalName();
            $file_path = $request->file('image')->store('order_images/',['disk'=>'public']);

            if($file_path){
                $order_image = [
                    'ext'=>$extension,
                    'name'=>$name,
                    'path'=>$file_path,
                ];
            }
        }

        $order = Orders::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'total'=>$request->total,
            'image'=>$order_image,
            'status'=>false,
        ]);

        $data=[
            'status'=> '200',
            'message' => 'success Order created successfully',
            'order' => $order,
        ];
        return response($data);
    }

    public function completeOrder(Orders $order)
    {
        if($order->status == false){
            $update = $order->update(['status' => true]);
            if($update){
                return redirect()->route('dashboard.orders.index')->withSuccessMessage('Order Completed');
            }
        }else{
            $update = $order->update(['status' => false]);
            if($update){
                return redirect()->route('dashboard.orders.index')->withErrorMessage('Order Is pending');
            }
        }

    }
}
