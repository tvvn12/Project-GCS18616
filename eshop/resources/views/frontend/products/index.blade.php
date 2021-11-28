@extends('layouts.front')
@section('title')
{{$category->name}}
@endsection
@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('category')}}">Collections</a>/
            <a href="">
            {{$category->name}}
        </a>
             
        </h6>
    </div>
</div>
<div class="py-5">
     <div class="container">
         <div class="col-md-12">
         <h2>{{$category->name}} <h2>
         <div class="row">
            @foreach($products as $prod)
             <div class="col-md-3">
                 <div class="card">
                     <a href="{{url('category/'.$category->slug.'/'.$prod->slug)}}">
                     <img   width="300" height="300" src="{{asset('assets/uploads/products/'.$prod->image)}}" alt="Product Image">
                     <div class="card-body">
                         <h5>{{$prod->name}}</h5>
                         <span class="float-start">{{$prod->selling_price}}$(USD)</span>
                     </div>
                     </a>
                 </div>
             </div>
             @endforeach
      
</div>
         </div>
     </div>
 </div>
@endsection