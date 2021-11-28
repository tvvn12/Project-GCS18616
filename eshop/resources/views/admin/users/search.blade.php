@extends('layouts.admin')

@section('content')
    <div class="card">
    <div class="card-body">
        <div class="card-header">
            <h4>Account Manager</h4>
            <hr>
            <form class="navbar-form" type="get" action="{{url('/search-user')}}">
              <div class="input-group no-border">
                <input type="text" name="s" value="" class="form-control" placeholder="Search account...">
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
            
                    <th>Name</th>
                    
                    
                    
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $danh as $item )
                    
               
                <tr>
                    <td>{{ $item->id}}</td>
                    <td>{{ $item->name}}</td> 
                    <td>{{ $item->email}}</td>
                    <td>{{ $item->phone}}</td>
                    
                    <td>
                        <a href="{{url('view-users/'.$item->id)}}" class="btn btn-primary btn-sm">View</a>


                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection
