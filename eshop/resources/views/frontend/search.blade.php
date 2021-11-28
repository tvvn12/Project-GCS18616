@extends('layouts.front')
@section('title')
 Welcome to E-shop
@endsection
@section('content')
@include('layouts.inc.slider')
<hr>
<center>
    <h4>Subscribe me</h4>
<script src="https://apis.google.com/js/platform.js"></script>

<div class="g-ytsubscribe" data-channelid="UCk7kfbpVFClRCeKQvk9Qf4w" data-layout="full" data-theme="dark" data-count="hidden"></div>
</center>
<form class="navbar-form" type="get" action="{{url('/search-pro')}}">
              <div class="input-group no-border">
                <input type="text" name="s" value="" class="form-control" placeholder="Search product...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>

<div class="py-5">
     <div class="container">
         <div  class="">
      <center>   <h2>Search Results: <h2></center>
         <div class="  ">
            @foreach($danhmuc as $prod)
             <div class="">
                 <a href="{{url('view-product/'.$prod->slug)}}">
                 <center class="">
                     <img width="120" height="120" src="{{asset('assets/uploads/products/'.$prod->image)}}" alt="Product Image">
                     <div class="">
                         <h5>{{$prod->name}}</h5>
                         <span class="">{{$prod->selling_price}} $(USD)</span>
                     </div>
                 </center>
                 </a>
             </div>
             @endforeach
        </div>
            
         </div>
     </div>
 </div>
@endsection
@section('scripts')
<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>
<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>
<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "113570526946517");
  chatbox.setAttribute("attribution", "biz_inbox");
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v11.0'
    });
  };
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
<script>

$('.featured-carousel').owlCarousel({
    loop:false,
    margin:10,
    nav:false,
    dots: 0,
    responsive:{
      
        500:{
            items:1
        }
    }
})
</script>
@endsection