<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $product_id =$request->input('product_id');
        $product_qty =$request->input('product_qty');

        if(Auth::check())
        {
            $pro_check =Product::where('id',$product_id)->first();
            if($pro_check)
            {
                if(Cart::where('pro_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    return response()->json(['status'=>$pro_check->name." Added before"]);
                }
                else{
                $cartItem = new Cart();
                $cartItem->pro_id =$product_id;
                $cartItem->user_id =Auth::id();
                $cartItem->pro_qty =$product_qty;
                $cartItem->save();
                return response()->json(['status'=>$pro_check->name." Successfully added to cart"]);
                }
             }
        }
        else{
            return response()->json(['status'=>"Please Login"]);
        }
    }
    public function viewCart()
    {
        $cartitem = Cart::where('user_id',Auth::id())->get();
        return view('frontend.cart',compact('cartitem'));
    }
    public function deleteproduct(Request $request)
    {
        if(Auth::check()){
        $pro_id =$request->input('pro_id');
            if(Cart::where('pro_id', $pro_id)->where('user_id',Auth::id())->exists())
            {
                $cartItem = Cart::where('pro_id', $pro_id)->where('user_id',Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status'=>"Product removed"]);
            }
        }
        else{
            return response()->json(['status'=>"Please Login"]);
        }

    }
    public function updatecart(Request $request)
    {
        $pro_id =$request->input('pro_id');
        $product_qty =$request->input('pro_qty');
        if(Auth::check())
        {
            if(Cart::where('pro_id', $pro_id)->where('user_id',Auth::id())->exists())
            {
                $cart = Cart::where('pro_id', $pro_id)->where('user_id',Auth::id())->first();
                $cart->pro_qty = $product_qty;
                $cart->update();
                return response()->json(['status'=> "Quantity updated"]);
            }
        }
    }
    public function cartcount()
    {
        $cartcount =Cart::where('user_id',Auth::id())->count();
        return response()->json(['count'=>$cartcount]);
    }

    public function wishlistcount()
    {
        $wishcount= Wishlist::where('user_id',Auth::id())->count();
        return response()->json(['count'=> $wishcount]);
    }
}
