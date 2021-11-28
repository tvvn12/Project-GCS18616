@extends('layouts.front')
@section('title')
My Cart
@endsection
@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}">
                Home
            </a>/
            <a href="{{url('cart')}}">
            Cart
        </a>
        
        </h6>
    </div>
</div>
<div class="container my-5">
    <div class="card shadow ">
        @if($cartitem->count()>0)
        <div class="card-body">
            <!-- @php $total=0; @endphp -->
            @foreach($cartitem as $item)
            <div class="row product_data" >
                <div class="col-md-2 my-auto">
                    <img src="{{asset('assets/uploads/products/'.$item->products->image)}}" height="70px" width="70px" alt="Image Here">
                </div>
                <div class="col-md-3 my-auto">
                    <h6>{{$item->products->name}}</h6>
                </div>
                <div class="col-md-2 my-auto">
                    <h6>{{$item->products->selling_price}} $(USD)</h6>
                </div>
                <div class="col-md-3 my-auto">
                    <input type="hidden" class="pro_id" value="{{$item->pro_id}}">
                 @if($item->products->qty >= $item->pro_qty)
                    <label for="Quantity"> Quantity/Kg</label>
                    <div class="input-group text-center mb-3" style="width:130px;">
                    <button class="input-group-text changeQuantityBtn decrement-btn">-</button>
                    <input type="text" name="quantity" class="form-control qty-input text-center" value="{{$item->pro_qty}}">
                    <button class="input-group-text changeQuantityBtn increment-btn">+</button>
                </div>
                @php $total += $item->products->selling_price * $item->pro_qty; @endphp
                @else
                <h6>Out of Stock</h6>
                @endif
                </div>
                <div class="col-md-2 my-auto">
                    <button class="btn btn-danger delete-cart-item"> <i class="fa fa-trash"></i> Remove</button>
                </div>
            </div>
          
            @endforeach
        </div>
        <div class="card-footer">
            <h6>Total Price:  {{$total}}$(USD)

            <a href="{{url('checkout')}}" class="btn btn-outline-success float-end">Payment</a>
            </h6>
           
        </div>
        @else
        <div class="card-body text-center">
            <h2>Cart <i class="fa fa-shopping-cart"></i> Empty</h2>
            <a href="{{ url('category')}}" class="btn btn-outline-primary float-end">Continue shopping </a>
        </div>
        @endif
    </div>
</div>
@endsection