@extends('layouts.front')
@section('title')
Order history
@endsection
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h4>My orders</h4>
                <hr>
                <form class="navbar-form" type="get" action="{{url('/search-my-order')}}">
              <div class="input-group no-border">
                <input type="text" name="s" value="" class="form-control" placeholder="Search order...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
                </div>
                <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tracking_No</th>
                            <th>Total price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $item)
                        <tr>
                            <td>{{$item->tracking_no}}</td>
                            <td>{{$item->total_price}}</td>
                            <td>{{$item->status=='0'?'Pending':'Delivered'}}</td>
                            <td>
                                <a href="{{ url('view-order/'.$item->id)}}" class="btn btn-primary">View details</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection