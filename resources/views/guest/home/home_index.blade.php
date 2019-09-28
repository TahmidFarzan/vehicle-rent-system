@extends('layouts.app')

@section('title')
Home
@endsection

@section('content')
<div class="row">
        <div class="col-lg-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                       <div class="carousel-inner" role="listbox">
                         @foreach($HomeSlider as $hs)
                          @if($hs->slider_sequence==1)
                             <div class="item active" align="center">
                                  <a href="{{$hs->slider_url}}"><img src="{{ asset('image/home/slider/'.$hs->slider_name) }}" alt="{{$hs->slider_alt}}" class="img-responsive"></a>
                              </div>
                          @else
                            <div class="item" align="center">
                                 <a href="{{$hs->slider_url}}"><img src="{{ asset('image/home/slider/'.$hs->slider_name) }}" alt="{{$hs->slider_alt}}" class="img-responsive"></a>
                            </div>
                          @endif
                        @endforeach
                        </div>
                    </div>
                     
                </div>
            </div>
            <!-- Fixed Intro div Start -->
            <div class="panel panel-default">
                <div class="panel-body">
                  <div class="container">  
                      <center><h1 style="margin-bottom: 20px;">Welcome to Vehicle Rent System</h1></center>
                      <p style="text-align:  justify">
                      Hiring a car from <strong>Vehicle Rent System in Banglades</strong>h will give you the freedom to explore the big cities and surrounding countryside at your own pace.
                      Travel quickly, safely and easily between towns and experience more of what this beautiful Bangladesh has to offer.
                      <strong>Vehicle Rent System in Bangladesh </strong>has the largest selections of exotic and premium vehicle for rent.  <strong>Vehicle Rent System in Dhaka </strong>provide personalized service to make sure that we meet your needs and exceed your expectations. In our fleet we have cars, micro bus, pickups, covered van, and trucks are available for hourly, daily and monthly basis rental. For personal or pleasure, the <strong>Vehicle Rent System</strong> exotic car collection offers a premium solution. So, rent a car from us and save time, money and reduce your stress on the way to work.
                      </p>                      
                  </div>
                </div>
            </div>
            <!-- Fixed Intro div End -->

            <!-- Fixed  Offer div Start -->
            <div class="panel panel-default">
                <div class="panel-body">
                  <div class="container">  
                     <div class="col-lg-6 col-md-6 col-sm-12 banner">
                        <img src="{{ asset('image/home/home/tourist-bus.jpg') }}" alt="No image" class="img-responsive">
                     </div>
                     <div class="col-lg-6 col-md-6 col-sm-12">
                        <center><h3 class="title"><p>Offer from Vehicle Rent System</p></h3></center><p style="text-align:  justify">Vehicle Rent System in Dhaka, Bangladesh is the best way to carry out a fascinating travel across Bangladesh. We provide comfortable, easiest and cheapest rent a car service in large Bangladesh. If you rent a car from us you always get 10% discount considering total rent. Travelling with Haque rent a car you can enjoy a dream vacation and save money. Take advantage of our discounts on car hire Bangladesh.</p>
                     </div>                   
                  </div>
                </div>
            </div>
            <!-- Fixed  Offer div End -->

            <!-- Fixed Feature div Start -->
            <div class="panel panel-default">
                <div class="panel-body">
                  <div class="container">  
                      <div class="col-lg-3 col-md-6 col-sm-12 banner">
                         <img src="{{ asset('image/home/home/about-feature3.jpg') }}" alt="No image" class="img-responsive">
                         <p><center><h4 class="title">Packges</h4> </center></p>              
                            <p style="text-align:justify">Vehicle Rent System provide Hourly, daily and Monthly basis car rental service for the clients. We are the easiest and cheapest rent a car service in large Bangladesh.</p>
                      </div>

                     <div class="col-lg-3 col-md-6 col-sm-12 banner">
                        <img src="{{ asset('image/home/home/about-feature.jpg') }}" alt="No image" class="img-responsive">
                        <p><center><h4 class="title">Our Brands</h4> </center></p>         
                        <p style="text-align:justify">Vehicle Rent System provide all latest brands vehicle for the clients.</p>
                     </div>

                     <div class="col-lg-3 col-md-6 col-sm-12 banner" >
                        <img src="{{ asset('image/home/home/about-feature2.jpg') }}" alt="No image" class="img-responsive">
                        <p><center><h4 class="title">Professional</h4> </center></p>         
                        <p style="text-align:justify">Vehicle Rent System in Dhaka, Bangladesh always practice professionalism with the clients.</p>
                     </div>

                     <div class="col-lg-3 col-md-6 col-sm-12 banner">
                        <img src="{{ asset('image/home/home/about-feature4.jpg') }}" alt="No image" class="img-responsive">
                        <p><center><h4 class="title">Highly Available</h4> </center></p><p style="text-align:justify">Which brand car you looking for, just let us know which is avail able in the Haque rent a car Bangladesh.</p>
                     </div>
                                       
                  </div>
                </div>
            </div>
            <!-- Fixed Feature div End -->

            <!-- Dynameic Feature div Start -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="container">
                        <div class="col-lg-6 col-md-6 col-sm-12 banner">
                           <img src="{{ asset('image/home/home/city1.jpg') }}" alt="No image" class="img-responsive">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">  
                             @foreach($HomeDetail as $hd)
                                  {!!html_entity_decode($hd->description)!!}
                              @endforeach
                      </div>
                   </div>
                </div>
            </div>
            <!-- Dynameic Feature div End -->
        </div>
</div>

   <!-- Jquery -->
   <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
   <!-- Jquery form validator -->
   <script src="{{asset('js/jquery.validate.js')}}"></script>
   <script src="{{asset('js/additional-methods.js')}}"></script>
   <!-- Hand made Jquery -->
   <script type="text/javascript">
    // Desgine error message
    $.validator.setDefaults({
      errorClass:'help-block',
      highlight:function(element){
        $(element)
         .closest('.my-form-div')
         .addClass('has-error');
      },
      unhighlight:function(element){
        $(element)
         .closest('.my-form-div')
         .removeClass('has-error');
      }
    });

      // Form validate 
        $('#Search_route_form').validate({
          rules:{
            destination:{
              required:true
            },
            origin:{
              required:true
            }
            
          }
        });

  setTimeout(function(){

        $("div.alert").remove();
    }, 3500 );
   // Time out for  <span class="help-block"> </div>
  setTimeout(function(){

        $("span.help-block").remove();
    }, 3500 );
  </script>
@endsection
