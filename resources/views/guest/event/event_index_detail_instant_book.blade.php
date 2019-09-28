@extends('layouts.app')

@section('title')
Event Rent book
@endsection

@section('content')
<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel-body">@include('message.message_block')</div>
            <div class="panel panel-default">
              <div class="panel-body"><center><h3>Event rent book</h3></center></div>
                <div class="panel-body">
                     <form class="form-horizontal" method="POST" id="Event_request_rent_form" action="{{ route('event-rent.store') }}">
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

                         <div class="form-group{{ $errors->has('event') ? ' has-error' : '' }}">
                               <label for="event" class="col-md-4 control-label"><p>Event</p></label>

                                <div class="col-md-6">
                                  <select name="event" id="event" class="form-control">
                                    <option value="{{$EventDetail->id}}" selected>{{$EventDetail->name}} </option>
                                  </select>

                                   @if ($errors->has('event'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('event') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                         </div>
                         
                         <div class="form-group{{ $errors->has('ticket_amount') ? ' has-error' : '' }}">
                               <label for="ticket_amount" class="col-md-4 control-label"><p>Ticket amount</p></label>
                                <div class="col-md-6">
                                  <input id="ticket_amount" type="number" class="form-control" name="ticket_amount" value="{{ old('ticket_amount') }}" placeholder="Ex: 1" min="1">
                                   @if ($errors->has('ticket_amount'))
                                     <span class="help-block">
                                        <strong>{{ $errors->first('ticket_amount') }}</strong>
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
        // Vehicle count
        $(document).on('change','#vehicle_type',function(){
          var vehicle_type_id=$(this).val();
          $.ajax({
                  type:'get',
                  url:'home/event/vehicle/count',
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
    $("#Event_request_rent_form").validate({
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
        description:{
          required:true
        },
        vehicle_amount:{
          required:true,
          number:true
        },
        ticket_amount:{
          required:true,
          number:true
        },
        vehicle_type:{
          required:true,
          maxlength:10,
          number:true,
          min:1
        },
        event:{
          required:true,
          maxlength:10,
          number:true,
          min:1
        }

      },
      messages:{
          mobile:{
          required:"This is required.",
          maxlength:"Enter a max char 112."
        },
         vehicle_amount:{
          required:"This is required.",
          max:"Book Rent can't be more then total vehicle."
        },
        ticket_amount:{
          required:"This is required."
        },
        vehicle_type:{
          required:"Vehicle type is required.",
          maxlength:"Max length 10"
        }

        }
  });

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
