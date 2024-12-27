<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        return view('products');
    }

    public function buyNow(Request $request){
        
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'You need to be logged in to purchase.'], 401);
        }

        try {

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $request->product_price,
            ]);

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $request->product_id,
                'quantity' => 1,
                'price' => $request->product_price,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
            ]);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
     }

    public function myOrders()
    {
        try{
            $orders = Order::with(['orderDetails.product'])->where('user_id', Auth::id())->get();
            return view('my_orders', compact('orders'));
        }
        catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
