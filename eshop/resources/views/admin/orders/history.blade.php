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
                <h4 class="text-white">Order history
                    <a href="{{'orders'}}" class="btn btn-warning float-right">Purchase order</a>
                </h4>
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
