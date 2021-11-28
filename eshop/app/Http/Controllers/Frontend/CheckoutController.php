<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        $old_Cartitems = Cart::where('user_id', Auth::id())->get();
        foreach($old_Cartitems as $item)
        {
            if(!Product::where('id', $item->pro_id)->where('qty' ,'>=', $item->pro_qty)->exists())
            {
                $removeItem = Cart::where('user_id',Auth::id())->where('pro_id', $item->pro_id)->first();
                $removeItem->delete();
            }
        }

        $cartitems = Cart::where('user_id',Auth::id())->get();

        $total=0;
        $cartitems_total =Cart::where('user_id',Auth::id())->get();
        foreach($cartitems_total as $prod)
        {
            $total += $prod->products->selling_price * $prod->pro_qty;
        }
        $cartitems->total_price = $total;

        return view('frontend.checkout',compact('cartitems'));
    }



    public function placeorder(Request $request)
    {
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname =$request->input('fname');
        $order->lname =$request->input('lname');
        $order->email =$request->input('email');
        $order->phone =$request->input('phone');
        $order->address1 =$request->input('address1');
        $order->address2 =$request->input('address2');
        $order->city =$request->input('city');
        $order->state =$request->input('state');
        $order->country =$request->input('country');
        $order->pincode =$request->input('pincode');

        $order->payment_mode =$request->input('payment_mode');
        $order->payment_id =$request->input('payment_id');


        //tính tổng
        $total=0;
        $cartitems_total =Cart::where('user_id',Auth::id())->get();
        foreach($cartitems_total as $prod)
        {
            $total += $prod->products->selling_price * $prod->pro_qty;
        }
        $order->total_price = $total;
        
        $order->tracking_no ='E-shop'.rand(1111,9999);
        $order->save();

        

        $cartitems = Cart::where('user_id',Auth::id())->get();
        foreach($cartitems as $item)
        {
            OrderItems::create([
                'order_id'=>$order->id,
                'pro_id' => $item->pro_id,
                'qty' => $item->pro_qty,
                'price'=> $item->products->selling_price,
            ]);
            $prod =Product::where('id',$item->pro_id)->first();
            $prod->qty = $prod->qty - $item->pro_qty;
            $prod->update();
        }

        if(Auth::user()->address1 == NULL)
        {
            $user= User::where('id', Auth::id())->first();
            $user->name =$request->input('fname');

            $user->lname =$request->input('lname');
            $user->phone =$request->input('phone');
            $user->address1 =$request->input('address1');
            $user->address2 =$request->input('address2');
            $user->city =$request->input('city');
            $user->state =$request->input('state');
            $user->country =$request->input('country');
            $user->pincode =$request->input('pincode');
            $user->update();
        }
        Mail::send('email.Checkout',$order->toArray(),
        function($mess){
            $mess->to('tvvn12@gmail.com','Vinh')->subject('New Order');
        });

        $cartitems = Cart::where('user_id',Auth::id())->get();
        Cart::destroy($cartitems);

        if($request->input('payment_mode')=="Pay by Razor"||$request->input('payment_mode')=="Pay by Paypal")
        {
            return response()->json(['status'=>"Order Success"]);
        }
        return redirect('/')->with('status',"Order Success");
        

    }

    function razorepaycheck(Request $request)
    {
        $cartitems =Cart::where('user_id',Auth::id())->get();
        $total_price=0;
        foreach($cartitems as $item)
        {
            $total_price += $item->products->selling_price * $item->pro_qty;
        }
                $firstname= $request ->input('firstname');
                $lastname= $request ->input('lastname');
                $email= $request ->input('email');
                $phone= $request ->input('phone');
                $address1= $request ->input('address1');
                $address2= $request ->input('address2');
                $city= $request ->input('city');
                $state= $request ->input('state');
                $country= $request ->input('country');
                $pincode= $request ->input('pincode');
                return response()->json([
                    'firstname'=>  $firstname,
                    'lastname'=>  $lastname,
                    'email'=>  $email,
                    'phone'=>  $phone,
                     'address1'=>  $address1,
                     'address2'=>  $address2,
                     'city'=>  $city,
                     'state'=>  $state,
                     'country'=>  $country,
                     'pincode'=>  $pincode,
                     'total_price'=> $total_price,
                ]);
    }
}
