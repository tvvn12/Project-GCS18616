<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function add($product_slug)
    {
        $product =Product::where('slug', $product_slug)->where('status','0')->first();
        if($product)
        {
            $product_id = $product->id;
            $review = Review::where('user_id',Auth::id())->where('pro_id',$product_id)->first();
            if($review)
            {
                return view('frontend.reviews.edit',compact('review'));

            }
            else{
            $verified_purchase= Order::where('orders.user_id',Auth::id())
             ->join('order_items','orders.id','order_items.order_id')
             ->where('order_items.pro_id',$product_id)->get();
             return view('frontend.reviews.index',compact('product','verified_purchase'));
            }
        }
        else{
            return redirect()->back()->with('status',"Link broken");
        }
    }
    public function create(Request $request)
    {
        $product_id= $request->input('product_id');
        $product =Product::where('id', $product_id)->where('status','0')->first();
        if($product)
        {
            $user_review = $request->input('user_review');
            $new_review =Review::create(
                [
                    'user_id'=> Auth::id(),
                    'pro_id'=>$product_id,
                    'user_review'=>$user_review
                ]
                );
                $categoty_slug = $product->category->slug;
                $product_slug = $product->slug;
                if($new_review)
                {
                    return redirect('category/'.$categoty_slug.'/'.$product_slug)->with('status',"Thanks for writing a review");
                }
        }
        else{
            return redirect()->back()->with('status',"Link broken");

        }
       

    }
    public function edit($product_slug)
    {
        $product =Product::where('slug', $product_slug)->where('status','0')->first();
        if($product)
        {
            $product_id= $product->id;
            $review =Review::where('user_id',Auth::id())->where('pro_id',$product_id)->first();
            if($review)
            {
                return view('frontend.reviews.edit',compact('review'));
            }
            else
            {
            return redirect()->back()->with('status',"Link broken");

            }
        }
        else
        {
        return redirect()->back()->with('status',"Link brokne");

        }
    }
    public function update(Request $request)
    {
        $user_review=$request->input('user_review');
        if($user_review != '')
        {
            $review_id= $request->input('review_id');
            $review =Review::where('id',$review_id)->where('user_id',Auth::id())->first();
            if($review)
            {
                $review->user_review =$request->input('user_review');
                $review->update();
                return redirect('category/'.$review->product->category->slug.'/'.$review->product->slug)->with('status',"Review updated successfully");
            }
            else
                {
                return redirect()->back()->with('status',"Link broken");

                }
        }
        else
        {
        return redirect()->back()->with('status',"You cannot submit an empty review");

        }
    }
}
