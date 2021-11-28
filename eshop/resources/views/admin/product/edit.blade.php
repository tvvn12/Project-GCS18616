@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Update Product</h4>
        </div>
    <div class="card-body">
       <form action="{{url('update-product/'.$products->id)}}" method="POST" enctype="multipart/form-data" required>
           @csrf
           @method('PUT')

       <div class="row">
           <div class="col-md-12 mb-3">
               <label for="">Category</label>
           <select class="form-select"  >
           <option required value="">{{$products->category->name}}</option>
               
            </select>
           </div>
       <div class="col-md-6 mb-3">
            <label for="">Name</label>
            <input required type="text" class="form-control" value="{{$products->name}}" name="name">
        </div>

        <div class="col-md-6 mb-3">
            <label for="">Slug</label>
            <input type="text" class="form-control"value="{{$products->slug}}" name="slug" required> 
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Small Description</label>
            <textarea type="text" class="form-control" name="small_description" required>{{$products->small_description}}</textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Description</label>
            <textarea type="description" rows="3" class="form-control" name="description" required>{{$products->description}}</textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Original Price</label>
            <input type="number"class="form-control" value="{{$products->original_price}}" name="original_price" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Selling Price</label>
            <input type="number"class="form-control" value="{{$products->selling_price}}" name="selling_price" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Tax</label>
            <input type="number"class="form-control" value="{{$products->taxsss}}" name="taxsss" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Quantity</label>
            <input type="number"class="form-control" value="{{$products->qty}}" name="qty" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Status</label>
            <input type="checkbox"  {{$products->status =="1"? 'checked':''}} name="status">
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Trending</label>
            <input type="checkbox" {{$products->trending=="1" ? 'checked':''}} name="trending">
        </div>

        <div class="col-md-6 mb-3">
            <label for="">Meta Title</label>
            <input type="text" value="{{$products->meta_title}}"  class="form-control" name="meta_title" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Meta Keywords</label>
            <textarea required class="form-control" rows="3" name="meta_keywords">{{$products->meta_keywords}}</textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Meta Description</label>
            <textarea required rows="3"  class="form-control" name="meta_description">{{$products->meta_description}}</textarea>

        </div>
        @if($products->image)
            <img src="{{asset('assets/uploads/products/'.$products->image)}}" alt="" >
           @endif
        <div class="col-md-12">
        
            <input type="file" class="form-control" name="image">
        </div>
        <div class="col-md-12">
          
            <button type="submit" class="btn btn-primary">Update</button>
        </div>

        
       </form>
    </div>
    </div>
@endsection
