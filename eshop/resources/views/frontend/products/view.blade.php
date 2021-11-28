@extends('layouts.front')
@section('title', $products->name)
@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{url('/add-rating')}}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{$products->id}}">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product Rating for {{$products->name}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                <div class="rating-css">
                    <div class="star-icon">
                        @if($user_rating)

                        @for($i=1; $i <= $user_rating->stars_rated; $i++)
                                <input type="radio" value="{{$i}}" name="product_rating" checked id="rating{{$i}}">
                                <label for="rating{{$i}}" class="fa fa-star "></label>
                        @endfor
                        @for($j=$user_rating->stars_rated+1;  $j<=5; $j++)
                                <input type="radio" value="{{$j}}" name="product_rating"  id="rating{{$j}}">
                                <label for="rating{{$j}}" class="fa fa-star "></label>
                        @endfor
                        @else
                        <input type="radio" value="1" name="product_rating" checked id="rating1">
                        <label for="rating1" class="fa fa-star"></label>
                        <input type="radio" value="2" name="product_rating" id="rating2">
                        <label for="rating2" class="fa fa-star"></label>
                        <input type="radio" value="3" name="product_rating" id="rating3">
                        <label for="rating3" class="fa fa-star"></label>
                        <input type="radio" value="4" name="product_rating" id="rating4">
                        <label for="rating4" class="fa fa-star"></label>
                        <input type="radio" value="5" name="product_rating" id="rating5">
                        <label for="rating5" class="fa fa-star"></label>
                   @endif
                    </div>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send Rating</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('category')}}">
                Colecctions
            </a>/
            <a href="{{url('view-category/'.$products->category->slug)}}">
            {{$products->category->name}} 
        </a>/
        <a href="{{url('category/'.$products->category->slug.'/'.$products->slug)}}">
    {{$products->name}}
    </a>
        </h6>
    </div>
</div>
<div class="container">
    <div class="card shadow product_data">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 border-right">
                    <img class="w-100" src="{{asset('assets/uploads/products/'.$products->image)}}" alt="">
                </div>
                <div class="col-md-8">
                    <h2 class="mb-0">
                        {{$products->name}}
                         <!-- fb thích -->
            
            <div class="fb-like" data-href="{{url('/view-product/'.$products->slug)}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div>
                        @if($products->trending=='1')
                        <label style="font-size: 16px;" class="float-end badge bg-danger trending_tag">Trending </label>
                    @endif
                    </h2>
                    <hr>
                    
                    <label class="fw-bold">Selling Price: {{$products->selling_price}}$(USD)</label>
                   @php $ratenum = number_format($rating_value) @endphp
                    <div class="rating">
                        @for($i=1; $i <= $ratenum; $i++)
                   
                    <i class="fa fa-star checked"></i>
                    @endfor
                   @for($j= $ratenum+1; $j<=5; $j++)
                    <i class="fa fa-star"></i>
                    @endfor
                    <span>
                    @if($ratings->count() >0)
                    {{$ratings->count()}} Ratings 
                    @else
                   
                    There are no ratings for this product 
                    @endif
                    </span>

                    </div>
                
                 <p class="mt-3">
                    {!! $products->small_description!!}
                </p>
                <hr>
                @if($products->qty >0)
                <label class="badge bg-success">Stocking</label>
                @else
                <label class="badge bg-danger">Out of stock</label>
                @endif
                <div class="row mt-2">
                    <div class="col-md-3">
                        <input type="hidden" value="{{$products->id}}" class="pro_id">
                        <label for="Quantity">Quantity</label>
                        <div class="input-group text-center mb-3">
                            <button class="input-group-text decrement-btn">-</button>
                            <input type="text" name="quantity " value="1" class="form-control qty-input text-center"/>
                            <button class="input-group-text increment-btn">+</button>
                        </div>
                    </div>
                    <div class="col-md-9">
</br>

                @if($products->qty >0)
                
                <button type="button" class="btn btn-primary me-3 addToCartBtn float-start">Add to Cart <i class="fa fa-shopping-cart"></i></button>     
                @endif

                <button type="button" class="btn btn-success me-3 addToWishlist float-start">Add to Wishlist <i class="fa fa-heart"></i></button>
                   
            </div>
                </div>
                </div>
            </div>
            <div class="col-md-12">
                <!-- fbshare -->
            <div id="fb-root"></div>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId=193075339531209&autoLogAppEvents=1" nonce="ycRzDZu6"></script>
            <div class="fb-share-button" data-href="{{url('/view-product/'.$products->slug)}}" data-layout="button_count" data-size="small"><a target="_blank" 
            href="https://www.facebook.com/sharer/sharer.php?u={{url('/view-product/'.$products->slug)}}" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
           
            <hr>
            <h3>Description</h3>
            <p class="mt-3">
                {!! $products->description!!}
            </p>
            <hr>

            <div class="row">
                <div class="col-md-4">

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Rating
                </button>
                <a href=" {{url('add-review/'.$products->slug.'/userreview')}}" class="btn btn-primary" >
                Write Review
                </a>
                </div>
                <div class="col-md-8">
                    @foreach($reviews as $item)
                    <div class="user-review">
                    <label for="">{{$item->user->name.''.$item->user->lname}}</label>
                    @if($item->user->id == Auth::id())
                    <a href="{{url('edit-review/'.$products->slug.'/userreview')}}">Edit</a>
                    @endif
                    <br>
                    @php
                    $rating = App\Models\Rating::where('pro_id',$products->id)->where('user_id',$item->user->id)->first();
                    @endphp
                    @if($rating)
                            @php $user_rated = $rating->stars_rated @endphp
                            @for($i=1; $i <= $user_rated; $i++)
                        
                            <i class="fa fa-star checked"></i>
                            @endfor
                            @for($j= $user_rated+1; $j<=5; $j++)
                            <i class="fa fa-star"></i>
                            @endfor
                    @endif
                    <small>Create at:  :  {{$item->created_at->format('d M Y')}}</small>
                    <p>
                        {{$item->user_review}}
                    </p>
                    </div>
                    @endforeach
                </div>
            </div>
            <br>
                <!-- cmtfb -->
            <h6 class="btn btn-success">Comment Facebook </h6>
            <div id="fb-root"></div>
                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId=193075339531209&autoLogAppEvents=1" nonce="PsYl0NxH"></script>
            </div>
    <div class="fb-comments" data-href="{{url('products/view/'.$products->slug)}}" data-width="" data-numposts="5"></div>
    
    </div>
        </div>
        
</div>
@endsection
