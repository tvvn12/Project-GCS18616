<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function add(Request $request)
    {
         $star = $request->input('product_rating');
         $product_id =$request->input('product_id');
         $product_check =Product::where('id',$product_id)->where('status','0')->first();
         if($product_check)
         {
              $verified_purchase= Order::where('orders.user_id',Auth::id())
             ->join('order_items','orders.id','order_items.order_id')
             ->where('order_items.pro_id',$product_id)->get();
            if($verified_purchase->count()>0)
            {
                $exiting_rating= Rating::where('user_id',Auth::id())->where('pro_id',$product_id)->first();
                if($exiting_rating)
                {
                        $exiting_rating->stars_rated =$star;
                        $exiting_rating->update();
                }
                else{
                Rating::create([
                    'user_id'=> Auth::id(),
                    'pro_id'=> $product_id,
                    'stars_rated'=>$star
                ]);
            }
            return redirect()->back()->with('status',"Submit a successful review");

            }
            else
            {
                return redirect()->back()->with('status',"You can not rate this product because you have not bought it before");
            }

         }
         else
         {
             return redirect()->back()->with('status',"Ossp!! Link broken");
         }
    }
}
