@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit category</h4>
        </div>
    <div class="card-body">
       <form action="{{url('update-category/'.$category->id)}}" method="POST" enctype="multipart/form-data">
           @csrf
        @method('PUT')
       <div class="row">
       <div class="col-md-6 mb-3">
            <label for="">Name</label>
            <input value="{{$category->name}}" type="text" class="form-control" name="name">
        </div>

        <div class="col-md-6 mb-3">
            <label for="">Slug</label>
            <input value="{{$category->slug}}" type="text" class="form-control" name="slug">
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Description</label>
            <textarea   type="description" rows="3" class="form-control" name="description">
                {{$category->description}}
            </textarea>
        </div>

        <div class="col-md-6 mb-3">
            <label for="">Status</label>
            <input {{$category->status=="1" ? 'checked':''}} type="checkbox"  name="status">
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Popular</label>
            <input  {{$category->popular=="1" ? 'checked':''}} type="checkbox" name="popular">
        </div>

        <div class="col-md-6 mb-3">
            <label for="">Meta Title</label>
            <input value="{{$category->meta_title}}" type="text" class="form-control" name="meta_title">
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Meta Keywords</label>
            <textarea  class="form-control" rows="3" name="meta_keywords">
                {{$category->meta_keywords}}
            </textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Meta Description</label>
            <textarea rows="3" class="form-control" name="meta_description">
                {{$category->meta_description}}
            </textarea>

        </div>
        @if( $category->image)
        <img src="{{asset('assets/uploads/category/'.$category->image)}}" alt="Category image">
        @endif
        <div class="col-md-12">
         
          
          <input type="file" class="form-control" name="image">
        </div>
        <div class="col-md-12">
          
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

        
       </form>
    </div>
    </div>
@endsection
