<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\OrderProducts;
use App\Models\Orders;
use Dotenv\Repository\RepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

        $data = $request->validate([
            'total_price'=> ['required','string'],
            'pickup_person_name'=> ['required','string'],
            'pickup_person_phone'=> ['required','string'],
            'shipping_address'=> ['required','string'],
            'products' => ['required', 'array', 'min:1'],
            'products.*.product_id' => ['required', 'numeric', Rule::exists('products', 'id')],
            'products.*.name' => ['required', 'string', Rule::exists('products', 'name')],
            'products.*.price' => ['required', 'string', Rule::exists('products', 'price')],
            'products.*.quantity' => ['required', 'numeric', 'min:1'],
        ]);
        // return response()->json(['message' => 'Order details recieved', 'products' => $request->all()]);

        $order = Orders::create([
            'total_price'=>$request->total_price,
            'pickup_person_name'=>$request->pickup_person_name,
            'pickup_person_phone'=>$request->pickup_person_phone,
            'shipping_address'=>$request->shipping_address,
            'user_id'=>auth()->user()->id,
            'status'=>false,
        ]);
        foreach ($data['products'] as $product) {
            $product['order_id'] = $order->id;
            OrderProducts::create($product);
        }

        $data=[
            'status'=> '200',
            'message' => 'success Order created successfully',
            'order' => $order,
        ];
        return response()->json($data);
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
