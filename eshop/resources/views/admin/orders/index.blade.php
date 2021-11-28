@extends('layouts.admin')

@section('title')
Order
@endsection
@section('content')
<div class="coitainer">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
                <div class="card-header bg-primary">
                <h4 class="text-white">New order 
                    <a href="{{'order-history'}}" class="btn btn-warning float-right">Order history</a>
                </h4>
               

              
                </div>
                <div class="float-right col-md-6 ">
                <form class="navbar-form" type="get" action="{{url('/search-order')}}">
                <div class="input-group no-border">
                <input type="text" name="s" value="" class="form-control" placeholder="Search...">
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
                            <td>Order date</td>
                            <th>Tracking_No</th>
                            <th>Total price</th>
                            <th>Status</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $item) 
                        <tr>
                            <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
                            <td>{{$item->tracking_no}}</td>
                            <td>{{$item->total_price}}</td>
                            <td>{{$item->status=='0'?'Pending':'Delivered'}}</td>

                            <td>
                                <a href="{{ url('admin/view-order/'.$item->id)}}" class="btn btn-primary">View</a>
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
