@extends('layouts.app_admin')

@section('title')
Route edit
@endsection

@section('content')
    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Admin</h1>
                    <!-- Messages -->
                    
                </div>
                
            </div>
            
            <div class="row">
               <!-- Right side -->
                <div class="col-lg-9">
                     <!-- Edit -->
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> Destination info</div>
                      <div class="panel-body">
                        {!! Form::model($Route,array('route' => ['admin-route.update',$Route->id],'method'=>'PUT','class'=>'form-horizontal','id'=>'Update_route_detail')) !!}
                          {{ csrf_field() }}
                         
                        
                         <div class="form-group">
                              <label for="from_place" class="col-md-3 control-label"><p>Custom route</p></label>
                              <div class="my-form-div col-md-3{{ $errors->has('from_place') ? ' has-error' : '' }}">
                                  <input type="text" name="from_place" id="from_place" placeholder="Enter from place" class="form-control" autocomplete="false" value="{{ $Route->origin }}" >
                                    @if ($errors->has('from_place'))
                                        <span class="help-block">
                                           <strong>{{ $errors->first('from_place') }}</strong>
                                        </span>
                                    @endif
                              </div>
                              <div class="my-form-div col-md-3 {{ $errors->has('to_place') ? ' has-error' : '' }}">
                                  <input type="text" name="to_place" id="to_place" placeholder="Enter to place" class="form-control" autocomplete="false" value="{{ $Route->destination }}">
                                                     
                                    @if ($errors->has('to_place'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('to_place') }}</strong>
                                      </span>
                                     @endif
                              </div>
                              <div class="col-md-3 form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                      <button type="submit" class="btn submit-ghost glyphicon glyphicon-road" id="cutome_distance_calculate"> Cal
                                                      </button>
                                    </div>
                              </div>
                         </div>
                         
                          <div class="form-group">
                                <label for="origin" class="col-md-3 control-label"><p>Origin</p></label>
                                <div class="my-form-div col-md-6{{ $errors->has('origin') ? ' has-error' : '' }}">
                                      <input id="origin" type="text" class="form-control" name="origin" value="{{ $Route->origin }}" placeholder="Ex: mirpur" readonly>
                                                
                                            @if ($errors->has('origin'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('origin') }}</strong>
                                                </span>
                                            @endif
                                </div>
                          </div>
                          <div class="form-group">
                                <label for="destination" class="col-md-3 control-label"><p>Destination</p></label>
                                <div class="my-form-div col-md-6{{ $errors->has('destination') ? ' has-error' : '' }}">
                                      <input id="destination" type="text" class="form-control" name="destination" value="{{ $Route->destination }}" placeholder="Ex: mirpur" readonly>
                                                
                                            @if ($errors->has('destination'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('destination') }}</strong>
                                                </span>
                                            @endif
                                </div>
                          </div>

                         <div class="form-group">
                               <label for="time" class="col-md-3 control-label"><p>Time hr(Depend on trafic)</p></label>
                               <div class="my-form-div col-md-6{{ $errors->has('time') ? ' has-error' : '' }}">
                                 <input id="time" type="text" class="form-control" name="time" value="{{ $Route->time }}" placeholder="Ex: 10.10 or 10" readonly>
                                   @if ($errors->has('time'))
                                       <span class="help-block">
                                         <strong>{{ $errors->first('time') }}</strong>
                                       </span>
                                  @endif
                               </div>
                         </div>
                          <div class="form-group">
                               <label for="distance" class="col-md-3 control-label"><p>Distance(Km)</p></label>
                               <div class="my-form-div col-md-6{{ $errors->has('distance') ? ' has-error' : '' }}">
                                 <input id="distance" type="text" class="form-control" name="distance" value="{{ $Route->distance }}" placeholder="Ex: 10" readonly>
                                 <div id="google_distance_matrix_map_error_message" class="google-map-error"></div>
                                   @if ($errors->has('distance'))
                                       <span class="help-block">
                                         <strong>{{ $errors->first('distance') }}</strong>
                                       </span>
                                  @endif
                               </div>
                          </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn glyphicon glyphicon-floppy-saved update-ghost">
                                   Update
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

  <!-- Jquery hand code -->
  <script type="text/javascript">
    //Hide google distance matrix map error message
   $('#google_distance_matrix_map_error_message').hide();
     
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
        $('#Update_route_detail').validate({
          rules:{
            origin:{
              required:true
            },
            destination:{
              required:true
            },
            from_place:{
              required:true
            },
            to_city:{
              required:true
            },
             time:{
              required:true,
              maxlength:50,
              latter_number_with_space:true
            },
            distance:{
              required:true,
              maxlength:50,
              float:true,
              min:0
            }
            
          }
        });

        // Allow any Float method
        jQuery.validator.addMethod("float", function(value, element) {
         return this.optional( element ) || /^\d*(\.\d{2})?$/.test( value );
         }, 'Only number or float allow with two digits after point(.).'); 

          // Allow any latter with space characters method
          jQuery.validator.addMethod("latter_number_with_space", function(value, element) {
              return this.optional( element ) || /^[A-Za-z0-9 ]+$/.test( value );
          }, 'Alphanumeric characters with space are allow.');




         // Time out for  <div class="alert "> </div>
  setTimeout(function(){

        $("div.alert").remove();
    }, 3500 );
   // Time out for  <span class="help-block"> </div>
  setTimeout(function(){

        $("span.help-block").remove();
    }, 3500 );
  </script>

  <!-- Google map -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?libraries=places&language=en&key=AIzaSyBj45DiF9gaLT65rRzcDzw6jKTz0wgD2Nc"
  type="text/javascript"></script>

<script type="text/javascript">
  $(function(){
   //Add input listener
   google.maps.event.addDomListener(window,'load',function(){
     var from_places=new google.maps.places.Autocomplete(document.getElementById('from_place'));
     var to_places=new google.maps.places.Autocomplete(document.getElementById('to_place'));

     google.maps.event.addListener(from_places,'place_changed',function(){
      var from_place=from_places.getPlace();
      var from_address=from_place.formatted_address;
      $('#origin').val(from_address);
     });

     google.maps.event.addListener(to_places,'place_changed',function(){
      var to_place=to_places.getPlace();
      var to_address=to_place.formatted_address;
      $('#destination').val(to_address);
     });

    });
    //Add Matrix
    function calculateDistance(){
      var origin=$('#origin').val();
      var destination=$('#destination').val();
      var service = new google.maps.DistanceMatrixService();
       service.getDistanceMatrix(
        {
          origins: [origin],
          destinations: [destination],
          travelMode: google.maps.TravelMode.DRIVING,
          unitSystem: google.maps.UnitSystem.METRIX,
          avoidHighways: false,
          avoidTolls: false,
        }, callback);
    }

    function callback(response, status) {
      if (status!=google.maps.DistanceMatrixStatus.OK) {
         $('#google_distance_matrix_map_error_message').html("Error");
      }
      else{
        var origin=response.originAddresses;
        var destination=response.destinationAddresses;
        if (response.rows[0].elements[0].status==="ZERO_RESULTS") {
            $('#google_distance_matrix_map_error_message').fadeIn('slow', function(){
               $('#google_distance_matrix_map_error_message').delay(3000).fadeOut(); 
            });
          $('#google_distance_matrix_map_error_message').html("No road get Plane.");
        }
        else{
          var distance=response.rows[0].elements[0].distance;
          var duration=response.rows[0].elements[0].duration;
          var distance_in_kilo=distance.value/1000;
          var duration_text=duration.text;
          $('#distance').val(distance_in_kilo.toFixed(2));
          $('#time').val(duration_text);
     
        }
      }
    }

    $('#cutome_distance_calculate').click(function(e){
      e.preventDefault();
      calculateDistance();
    });

  });
</script>
@endsection
