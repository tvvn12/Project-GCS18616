@extends('layouts.front')
@section('title')
Checkout
@endsection
@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}">
                Home
            </a>/
            <a href="{{url('checkout')}}">
            Payment
        </a>
        </h6>
    </div>
</div>
    <div class="container mt-3">
        <form action="{{url('place-order')}}" method="POST">
            {{csrf_field()}}
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6>Information</h6>
                        <hr>
                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <label for="">Họ: </label>
                                <input required class="form-control firstname" value="{{Auth::user()->name}}" name="fname" type="text"  placeholder="Enter First Name">
                                <span id="fname_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">Name: </label>
                                <input value="{{Auth::user()->lname}}" name="lname" type="text" required class="form-control lastname" placeholder="Enter Last Name">
                                <span id="lastname_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Email: </label>
                                <input value="{{Auth::user()->email}}" name="email" type="text" required  class="form-control email" placeholder="Enter Email">
                                <span id="email_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Phone: </label>
                                <input value="{{Auth::user()->phone}}" name="phone" type="text" required class="form-control phone" placeholder="Enter Phone">
                                <span id="phone_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Address 1: </label>
                                <input value="{{Auth::user()->address1}}" name="address1" type="text" required class="form-control address1" placeholder="Enter Address">
                                <span id="address1_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Address 2: </label>
                                <input value="{{Auth::user()->address2}}" name="address2" type="text" required class="form-control address2" placeholder="Enter Address">
                                <span id="address2_error"    class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">City: </label>
                                <input value="{{Auth::user()->city}}" name="city" type="text" required class="form-control city" placeholder="Enter City">
                                <span id="city_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">State: </label>
                                <input value="{{Auth::user()->state}}" name="state"  type="text" required class="form-control state" placeholder="Enter State">
                                <span id="state_error" class="text-danger"></span>
                            </div>
                            
                            <div class="col-md-6 mt-3">
                                <label for="">Country: </label>
                                <input value="{{Auth::user()->country}}" name="country" type="text" required class="form-control country" placeholder="Enter Country">
                                <span id="country_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">PIN CODE/ZIP CODE: </label>
                                <input value="{{Auth::user()->pincode}}" name="pincode" type="text" required class="form-control pincode" placeholder="Enter PINCODE/ZIPCODE">
                                <span id="pincode_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                Order information
                    <hr>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Unit price</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cartitems as $item)
                            <tr>
                                <td>{{ $item->products->name}}</td>
                                <td>{{ $item->pro_qty}}</td>
                                <td>{{ $item->products->selling_price}}</td>
                        
                        </tr>
                        @endforeach
                            
                        </tbody>
                    </table>
                    <h4 class="px-2">Total price: <span class="float-end">{{$cartitems->total_price}}$(USD)</span></h4>
                    <hr>
                    <input type="hidden" name="payment_mode" value="COD">
                    <button type="submit" class="btn btn-success w-100 float-end" >Buy now | COD</button>
                    <button type="button" class="btn btn-primary w-100 mt-3 razorpay_btn">Razor Pay</button>
                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </div>
        </div>
        </form>
        
    </div>
@endsection

@section('scripts')
<script
    src="https://www.paypal.com/sdk/js?client-id=AUgMHfzKCL9XBEpgt-BJCHdXyXjJ1U2s3RfEizaKDHEtz-S_j7qMeA1wNIUsa4oQgk-fDaXNnOZgfBGH"> // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
  </script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
  paypal.Buttons({
    createOrder: function(data, actions) { 
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '{{$cartitems->total_price}}'
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
        // This function shows a transaction success message to your buyer.
        // alert('Transaction completed by ' + details.payer.name.given_name);
                
                    var firstname  = $('.firstname').val();
                var lastname = $('.lastname').val();
                var email = $('.email').val();
                var  phone = $('.phone').val();
                var  address1 = $('.address1').val();
                var  address2 = $('.address2').val();
                var  city = $('.city').val();
                var  state = $('.state').val();
                var  country = $('.country').val();
                var  pincode = $('.pincode').val();
        $.ajax({
                                method:"POST",
                                url:"/place-order",
                                data:{
                                   'fname' :firstname,
                                   'lname' :lastname,
                                   'email' :email,
                                   'phone' :phone,
                                   'address1' :address1,
                                   'address2' :address2,
                                   'city' :city,
                                   'state' :state,
                                   'country' :country,
                                   'pincode' :pincode,
                                   'payment_mode':"Pay by Paypal",
                                   'payment_id':details.id,
                                },
                               
                                success: function(response)
                                {
                                    // alert(responseb.status);
                                    swal(response.status);
                                    window.setTimeout(function(){location.href ="/"},100);
                                    
                                }
                            });


    });
    }
  }).render('#paypal-button-container');
  //This function displays Smart Payment Buttons on your web page.
</script>
@endsection