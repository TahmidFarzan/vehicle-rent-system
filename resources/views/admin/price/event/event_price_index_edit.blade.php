@extends('layouts.app_admin')

@section('title')
VRS Event Rent
@endsection

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Admin panal</h1>
                    <!-- Message -->
                     @include('message.message_block')
                </div>
                
            </div>
            
            <div class="row">
                <!-- Right side -->
                <div class="col-lg-9">
                  <!-- Add -->
                   <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> Event price edit</div>
                      <div class="panel-body">
                          {!! Form::model($EventPriceDetail,array('route' => ['admin-event_price.update',$EventPriceDetail->id],'method'=>'PUT','class'=>'form-horizontal','id'=>'Edit_event_price_form')) !!}
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('event') ? ' has-error' : '' }}">
                               <label for="event" class="col-md-4 control-label"><p>Event</p></label>

                                <div class="col-md-6">
                                   {{ Form::select('event',$EventDetail,$EventPriceDetail->event_detail_id, ['placeholder' => 'Please select event','class'=>'form-control','id'=>'event']) }}

                                   @if ($errors->has('event'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('event') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>

                            <div class="form-group{{ $errors->has('vehicle_type') ? ' has-error' : '' }}">
                               <label for="vehicle_type" class="col-md-4 control-label"><p>Vehicle Type</p></label>

                                <div class="col-md-6">
                                   {{ Form::select('vehicle_type',$VehicleType, $EventPriceDetail->vehicle_type_id, ['placeholder' => 'Please select vehicle type','class'=>'form-control','id'=>'vehicle_type']) }}

                                   @if ($errors->has('vehicle_type'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('vehicle_type') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>

                           <div class="form-group{{ $errors->has('ticket_price') ? ' has-error' : '' }}">
                               <label for="ticket_price" class="col-md-4 control-label"><p>Ticket Price(Per person)</p></label>

                                <div class="col-md-6">
                                  <input id="ticket_price" type="number" class="form-control" name="ticket_price" value="{{ $EventPriceDetail->ticket_price }}" placeholder="Ex: 1000" min="0">

                                   @if ($errors->has('ticket_price'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('ticket_price') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>

                            <div class="form-group{{ $errors->has('vehicle_price') ? ' has-error' : '' }}">
                               <label for="vehicle_price" class="col-md-4 control-label"><p>Vehicle price</p></label>

                                <div class="col-md-6">
                                  <input id="vehicle_price" type="number" class="form-control" name="vehicle_price" value="{{ $EventPriceDetail->vehicle_price }}" placeholder="Ex: 1000" min="0">

                                   @if ($errors->has('vehicle_price'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('vehicle_price') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>

                            <div class="form-group{{ $errors->has('total_price') ? ' has-error' : '' }}">
                               <label for="total_price" class="col-md-4 control-label"><p>Total price</p><a href="javascript: void(0)" onClick="TotalPriceCalculate()" class="btn submit-ghost" id="calculate">Cal</a></label>

                                <div class="col-md-6">
                                  <input id="total_price" type="number" class="form-control" name="total_price" value="{{ $EventPriceDetail->total_price }}" placeholder="Ex: 100" min="0" readonly>

                                   @if ($errors->has('total_price'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('total_price') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>

                          
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn submit-ghost">
                                     Submit
                                   </button>
                               </div>
                             </div>
                          {!! Form::close() !!}
                      </div>    
                   </div>
                   
                </div>
                <!-- Left side -->
                @include('admin.feedback.feedback_index')
            </div>
            
</div>



<!-- Jquery -->
<script src="{{asset('js/jquery-3.3.1.js')}}"></script>
<!-- Jquery form validator -->
<script src="{{asset('js/jquery.validate.js')}}"></script>
<script src="{{asset('js/additional-methods.js')}}"></script>

<script type="text/javascript">

  // Event price call
 function TotalPriceCalculate() {
            var ticket = document.getElementById('ticket_price').value; 
            var vehicle = document.getElementById('vehicle_price').value;
            var total = parseInt(vehicle) + parseInt(ticket);
             document.getElementById('total_price').value = total;  
          }

// Desgine error message
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
    // Form validate 
        $('#Edit_event_price_form').validate({
          rules:{
            vehicle_price:{
              required:true,
              maxlength:10,
              number:true
            },
            ticket_price:{
              required:true,
              maxlength:10,
              number:true
            },
             total_price:{
              required:true,
              maxlength:10,
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
             price:{
              required:"Price is required.",
              maxlength:"Max length 10"
             },
             vehicle_type:{
               required:"Vehicle type is required.",
               maxlength:"Max length 10"
             },
              event:{
                required:"Event name amount is required.",
                maxlength:"Max length 50"
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
