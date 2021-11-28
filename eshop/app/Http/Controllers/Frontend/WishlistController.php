<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist =Wishlist::where('user_id',Auth::id())->get();
        return view('frontend.wishlist',compact('wishlist'));
    }
    public function add(Request $request)
    {
        if(Auth::check())
        {
            $pro_id=$request->input('product_id');
            $pro_check =Product::where('id',$pro_id)->first();
            
            if(Product::find($pro_id))
            {
                $wish = new Wishlist();
                $wish->pro_id =$pro_id;
                $wish->user_id =Auth::id();
                $wish->save();
                return response()->json(['status'=>"Product added to favorites"]);

            }
                else
                    {
                return response()->json(['status'=>" Item does not exist"]);

                    }
            
        }else{
            return response()->json(['status'=>"Please Login"]);

        }   
    }
    public function deleteitem(Request $request)
        {
            if(Auth::check()){
                $pro_id =$request->input('pro_id');
                    if(Wishlist::where('pro_id', $pro_id)->where('user_id',Auth::id())->exists())
                    {
                        $wish = Wishlist::where('pro_id', $pro_id)->where('user_id',Auth::id())->first();
                        $wish->delete();
                        return response()->json(['status'=>"Product removed from favorites"]);
                    }
                }
                else{
                    return response()->json(['status'=>"Please Login"]);
                }
        }
}
