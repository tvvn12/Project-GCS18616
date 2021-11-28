@extends('layouts.front')
@section('title', "Writing a Review")

@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if($verified_purchase->count()>0)
                    <h5>You are writing a product review for {{$product->name}}</h5>
                    <form action="{{url('add-review')}}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <textarea class="form-control" name="user_review" rows="5" placeholder="Viết đánh giá"></textarea>
                        <button type="submit" class="btn btn-primary  mt-3">Send</button>
                    </form>
                    @else
                            <div class="alert alert-danger">
                                <h5>You are not qualified to write a review</h5>
                                <p>
                                For trusted shoppers, Buyers can write a review for this product.
                                </p>
                                <a href="{{url('/')}}" class="btn btn-primary mt-3" >Go to Home Page</a>
                            </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection