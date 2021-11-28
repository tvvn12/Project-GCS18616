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
                <input type="text" name="s" value="" class="form-control" placeholder="Search products...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
<div class="py-5">
     <div class="container">
         <div class="row">
         <h2>Trending products<h2>
         <div class="owl-carousel featured-carousel owl-theme">
            @foreach($featured_products as $prod)
             <div class="item">
                 <a href="{{url('view-product/'.$prod->slug)}}">
                 <div class="card">
                     <img width="304" height="300" src="{{asset('assets/uploads/products/'.$prod->image)}}" alt="Product Image">
                     <div class="card-body">
                         <h5>{{$prod->name}}</h5>
                         <span class="float-start">{{$prod->selling_price}}$(USD)</span>
                        
                     </div>
                 </div>
                 </a>
             </div>
             @endforeach
        </div>
            
         </div>
     </div>
 </div>

 <div class="py-5">
     <div class="container">
         <div class="row">
         <h2>Popular Category<h2>
         <div class="owl-carousel featured-carousel owl-theme">
            @foreach($trending_category as $tcate)
             <div class="item">
                 <a href="{{url('view-category/'.$tcate->slug)}}">
                 <div class="card">
                     <img width="304" height="300" src="{{asset('assets/uploads/category/'.$tcate->image)}}" alt="Product Image">
                     <div class="card-body">
                         <h5>{{$tcate->name}}</h5>
                         <p>
                             {{$tcate->description}}
                         </p>
                     </div>
                 </div>
                 </a>
             </div>
             
             @endforeach
        </div>
        <center>
        <div class="fb-page" data-href="https://www.facebook.com/Shop-Online-113570526946517" data-tabs="timeline" data-width="" data-height="" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Shop-Online-113570526946517" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Shop-Online-113570526946517">Shop Online</a></blockquote></div>
        </center>
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
    loop:true,
    margin:10,
    nav:true,
    dots: 3,
    responsive:{
      
        1000:{
            items:3
        }
    }
})
</script>
@endsection