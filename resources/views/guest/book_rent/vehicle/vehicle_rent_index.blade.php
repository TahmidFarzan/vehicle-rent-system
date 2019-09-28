@extends('layouts.app')

@section('title')
Vehicle Rent book
@endsection

@section('content')
<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel-body">@include('message.message_block')</div>
            <div class="panel panel-default">
              <div class="panel-body"><center><h3>Vehicle rent book</h3></center></div>
                <div class="panel-body">
                     <form class="form-horizontal" method="POST" id="Guest_vehicle_rent_form" action="{{ route('vehicle-rent.store') }}">
                       {{ csrf_field() }}

                       @if (Auth::guest())
                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label"><p>Name</p></label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ex: Farzan">
                                  @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                  @endif
                            </div>
                          </div>

                          <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-4 control-label"><p>Mobile</p></label>
                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" placeholder="Ex: +88XXXXXXXXXX">
                                  @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                  @endif
                            </div>
                          </div>

                         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label"><p>Email</p></label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Ex: xx@xx.com">
                                  @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                  @endif
                            </div>
                         </div>
                      @endif

                      @auth('web')
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label"><p>Name</p></label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="Ex: Farzan" readonly>
                                  @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                  @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label"><p>Email</p></label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="Ex: xx@xx.com" readonly=>
                                  @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                  @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-4 control-label"><p>Mobile</p></label>
                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" placeholder="Ex: +88XXXXXXXXXX">
                                  @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                  @endif
                            </div>
                        </div>
                      @endauth

                        <div class="form-group{{ $errors->has('journey_date') ? ' has-error' : '' }}">
                            <label for="journey_date" class="col-md-4 control-label"><p>Journey date</p></label>
                            <div class="col-md-6">
                                <input id="journey_date" type="date" class="form-control" name="journey_date" value="{{ old('journey_date') }}" placeholder="">
                                  @if ($errors->has('journey_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('journey_date') }}</strong>
                                    </span>
                                  @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('return_date') ? ' has-error' : '' }}">
                            <label for="return_date" class="col-md-4 control-label"><p>Return date</p></label>
                            <div class="col-md-6">
                                <input id="return_date" type="date" class="form-control" name="return_date" value="{{ old('return_date') }}" placeholder="">
                                  @if ($errors->has('return_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('return_date') }}</strong>
                                    </span>
                                  @endif
                            </div>
                        </div>

                       <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label"><p>Description</p></label>
                            <div class="col-md-6">
                                <textarea id="description" class="form-control textarea" name="description" placeholder="Ex: Hello">{{ old('description') }}</textarea>
                                  @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                  @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('route') ? ' has-error' : '' }}">
                               <label for="event" class="col-md-4 control-label"><p>Route</p></label>

                                <div class="col-md-6">

                                   <select class="form-control" id="route" name="route">
                                     <option>Please select route</option>
                                     @foreach($Route as $route)
                                     <option value="{{$route->id}}">{{$route->origin}} - {{$route->destination}}</option>
                                     @endforeach
                                   </select>

                                   @if ($errors->has('route'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('route') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>

                            <div class="form-group{{ $errors->has('vehicle_type') ? ' has-error' : '' }}">
                               <label for="vehicle_type" class="col-md-4 control-label"><p>Vehicle Type</p></label>

                                <div class="col-md-6">
                                   {{ Form::select('vehicle_type',$VehicleType, null, ['placeholder' => 'Please select vehicle type','class'=>'form-control','id'=>'vehicle_type']) }}

                                   @if ($errors->has('vehicle_type'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('vehicle_type') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                               <label for="price" class="col-md-4 control-label"><p>Price(Per vehicle)</p></label>

                                <div class="col-md-6">
                                   <input id="price" type="text" class="form-control" name="price" placeholder="Ex: 1000" readonly>
                                  </div>
                            </div>

                           <div class="form-group{{ $errors->has('vehicle_amount') ? ' has-error' : '' }}">
                            <label for="vehicle_amount" class="col-md-4 control-label"><p>Vehicle amount</p></label>
                              <div class="col-md-6">
                                <input id="vehicle_amount" type="number" class="form-control" name="vehicle_amount" value="{{ old('vehicle_amount') }}" placeholder="Ex: 1" min="1">
                                  @if ($errors->has('vehicle_amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vehicle_amount') }}</strong>
                                    </span>
                                  @endif
                              </div>
                           </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn submit-ghost">
                                     Book
                                   </button>
                               </div>
                             </div>
                    </form>
                </div>
            </div>   
        </div>
</div>

 <!-- Jquery-->
   <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
   <!-- Jquery validator -->
   <script src="{{ asset('js/jquery.validate.js') }}"></script>
   <script src="{{ asset('js/additional-methods.js') }}"></script>
   <!-- Hand made Jquery -->
   <script type="text/javascript">
        // On load
       $(document).ready(function(){
        // Price found
          $(document).on('change','#route',function(){
           $(document).on('change','#vehicle_type',function(){
              var vehicle_type_id=$('#vehicle_type').val();
              var route_id=$('#route').val();
              $.ajax({
               type:'get',
                 url:'{!! URL::to('home/vehicle/rent/price/found')!!}',
                 data:{'route_id':route_id,'vehicle_type_id':vehicle_type_id},
                 success:function(data){
                    $('#price').empty();
                    $('#price').attr('value',data);
                  },
                 error:function(){
                  console.log('Fail.');
                 }
             });
            });
          });

        $(document).on('change','#vehicle_type',function(){
           $(document).on('change','#route',function(){
              var vehicle_type_id=$('#vehicle_type').val();
              var route_id=$('#route').val();
              $.ajax({
                type:'get',
                 url:'{!! URL::to('home/vehicle/rent/price/found')!!}',
                 data:{'route_id':route_id,'vehicle_type_id':vehicle_type_id},
                 success:function(data){
                    $('#price').empty();
                    $('#price').attr('value',data);
                  },
                 error:function(){
                  console.log('Fail.');
                 }
             });
            });
         });
        // Vehicle count
        $(document).on('change','#vehicle_type',function(){
          var vehicle_type_id=$(this).val();
          $.ajax({
                  type:'get',
                  url:'home/vehicle/count',
                  data:{'vehicle_type_id':vehicle_type_id},
                  success:function(data){
                   $('#vehicle_amount').empty();
                   $('#vehicle_amount').attr('max',data);
                   },
                  error:function(){
                   console.log("Error");
                  }
                });
        });
       });


     $.validator.setDefaults({
      errorClass:'help-block',
      highlight:function(element){
        $(element)
         .closest('.form-group')
         .addClass('has-error');
      },
      unhighlight:function(element){
        $(element)
         .closest('.form-group')
         .removeClass('has-error');
      }
    });

      //Form validation
    $("#Guest_vehicle_rent_form").validate({
      rules:{
         name:{
          required:true,
          maxlength:100,
          latter_with_space:true
        },
         mobile:{
          required:true,
          maxlength:112,
          mobile_no:true
        },
        email:{
          required:true,
          maxlength:50,
          email:true
        },
        journey_date:{
          required:true,
          date:true
        },
        return_date:{
          required:true,
          date:true,
          journey_return_date:true
        },
       description:{
          required:true
        },
        vehicle_amount:{
          required:true,
          number:true
        },
        vehicle_type:{
          required:true,
          maxlength:10,
          number:true,
          min:1
        },
        route:{
          required:true,
          maxlength:10,
          number:true,
          min:1
        }

      },
      messages:{
        name:{
          required:"This is required.",
          maxlength:"Enter a max char 100."
        },
          mobile:{
          required:"This is required.",
          maxlength:"Enter a max char 112."
        },
        email:{
          required:"This is required.",
          email:"Enter a valid email."
        },
        journey_date:{
          required:"This is required.",
          date:"Date format must (YYYY-MM-DD)."
        },
         return_date:{
          required:"This is required.",
          date:"Date format must (YYYY-MM-DD)."
        },
        take_off_address:{
          required:"This is required."
        },
         vehicle_amount:{
          required:"This is required.",
          max:"Book Rent can't be more then total vehicle."
        },
        vehicle_type:{
          required:"Vehicle type is required.",
          maxlength:"Max length 10"
        },
        route:{
          required:"Route is required.",
          maxlength:"Max length 50"
        }

        }
  });

   // journey return date validation
    jQuery.validator.addMethod("journey_return_date", function(value, element) {
      return !( $('#return_date').val() < $('#journey_date').val() )
     }, 'Not allowed.');

  // Allow any latter with space method
   jQuery.validator.addMethod("latter_with_space", function(value, element) {
  
    return this.optional( element ) || /^[A-Za-z ]*$/.test( value );
    }, 'Only Latter characters with space are allow.');

   // Allow any mobile method
   jQuery.validator.addMethod("mobile_no", function(value, element) {
  
    return this.optional( element ) || /^[0-9+,-]*$/.test( value );
    }, 'Only mobile no are allow.');

    // Time out for  <span class="help-block"> </span>
  setTimeout(function(){

        $("span.help-block").remove();
   }, 3500 );

      // Time out for  <div class="alert"> </span>
  setTimeout(function(){

        $("div.alert").remove();
   }, 3500 );
  

   </script>

@endsection
