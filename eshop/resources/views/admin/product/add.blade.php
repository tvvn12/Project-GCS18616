@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Add new product</h4>
        </div>
    <div class="card-body">
       <form action="{{url('insert-product')}}" method="POST" enctype="multipart/form-data">
           @csrf

       <div class="row">
           <div class="col-md-12 mb-3">
           <select required class="form-select" name="cate_id"  >
               <label for="">Category </label>+
                <option style="text-align: center;" value="">Select Category &#8681;		 </option> 
                @foreach($category as $item)
                <option  value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
           </div>
       <div class="col-md-6 mb-3">
            <label for="">Name</label>
            <input type="text" class="form-control"  name="name" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="">Slug</label>
            <input type="text" class="form-control"  name="slug"required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Small Description</label>
            <textarea required type="text" class="form-control" name="small_description"></textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Description</label>
            <textarea required type="description" rows="3" class="form-control" name="description"></textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Original Price</label>
            <input required type="number"class="form-control" name="original_price">
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Selling Price</label>
            <input required type="number"class="form-control" name="selling_price">
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Tax</label>
            <input required type="number"class="form-control" name="taxsss">
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Quantity</label>
            <input required type="number"class="form-control" name="qty">
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Status</label>
            <input  type="checkbox"  name="status">
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Trending</label>
            <input  type="checkbox" name="trending">
        </div>

        <div class="col-md-6 mb-3">
            <label for="">Meta Title</label>
            <input required type="text"  class="form-control" name="meta_title">
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Meta Keywords</label>
            <textarea required class="form-control" rows="3" name="meta_keywords"></textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Meta Description</label>
            <textarea required rows="3" class="form-control" name="meta_description"></textarea>

        </div>
        <div class="col-md-12">
          
            <input type="file" class="form-control" name="image" required>
        </div>
        <div class="col-md-12">
          
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>


       </form>
    </div>
    </div>
@endsection
