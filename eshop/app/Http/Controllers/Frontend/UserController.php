<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() 
    {
        $orders =Order::where('user_id',Auth::id())->get();
        return view('frontend.orders.index' ,compact('orders'));
    }
    public function view($id)
    {
        $orders = Order::where('id',$id)->where('user_id',Auth::id())->first();
        return view('frontend.orders.view',compact('orders'));
    }
    public function search_orders()
    {
        $s = $_GET['s'];
        $sorder =Order::where('user_id',Auth::id())->where('tracking_no','LIKE','%'.$s.'%')->get();
        return view('frontend.orders.search',compact('sorder'));
    }
    
}
