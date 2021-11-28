@extends('layouts.admin')

@section('content')
    <div class="card">
    <div class="card-body">
        <div class="card-header">
            <h4>Product Manager </h4>
            <hr>
            <form class="navbar-form" type="get" action="{{url('/search-pro-ad')}}">
              <div class="input-group no-border">
                <input type="text" name="s" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>

        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Selling Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $danhmuc as $item )
                <tr>
                    <td>{{ $item->id}}</td>
                    <td>{{ $item->category->name}}</td> 
                    <td>{{ $item->name}}</td>
                    <td>{{ $item->selling_price}}</td>
                    <td>
                    <img class="cate-image" src="{{asset('assets/uploads/products/'.$item->image)}}" alt="Image here"> 
                    </td>
                    <td>
                        <a href="{{url('edit-products/'.$item->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{url('delete-products/'.$item->id)}}" class="btn btn-danger btn-sm">Delete</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection
