@extends('layouts.front')
@section('title')
 My Wishlist
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}">
               Home
            </a>/
            <a href="{{url('wishlist')}}">
            Wishlist
        </a>
        </h6>
    </div>
</div>
<div class="container my-5">
    <div class="card shadow ">
        <div class="card-body">    
       @if($wishlist->count()>0)
            @foreach($wishlist as $item)
            <div class="row product_data" >
                <div class="col-md-2 my-auto">
                    <img src="{{asset('assets/uploads/products/'.$item->products->image)}}" height="70px" width="70px" alt="Image Here">
                </div>
                <div class="col-md-2 my-auto">
                    <h6>{{$item->products->name}}</h6>
                </div>
                <div class="col-md-2 my-auto">
                    <h6>{{$item->products->selling_price}} $(USD)</h6>
                </div>
                <div class="col-md-2 my-auto">
                    <input type="hidden" class="pro_id" value="{{$item->pro_id}}">
                 @if($item->products->qty >= $item->pro_qty)
                    
                    <label for="Quantity"> Quantity/Kg</label>
                    <div class="input-group text-center mb-3" style="width:130px;">
                    <button class="input-group-text  decrement-btn">-</button>
                    <input type="text" name="quantity" class="form-control qty-input text-center" value="1">
                    <button class="input-group-text  increment-btn">+</button>
                </div>
                @else
                <h6>Out of stock</h6>
                @endif
                </div>
                <div class="col-md-2 my-auto">
                    <button class="btn btn-success addToCartBtn "> <i class="fa fa-shopping-cart"></i>Add to cart</button>
                </div>
                <div class="col-md-2 my-auto">
                    <button class="btn btn-danger remove-wishlist-item "> <i class="fa fa-trash"></i>Removed</button>
                </div>
            </div>
            @endforeach
       @else
       <h4>No favorite products</h4>
       <a href="{{ url('category')}}" class="btn btn-outline-primary float-end">Continue shopping</a>
       @endif
       </div>
    </div>
</div>
@endsection