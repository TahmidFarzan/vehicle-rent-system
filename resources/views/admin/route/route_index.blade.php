@extends('layouts.app_admin')

@section('title')
Route
@endsection

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                   <!-- Messages -->
                     @include('message.message_block')
                </div>
                
            </div>

            <div class="row">
                <div class="col-lg-9">
                     <!-- Add -->
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-dashboard fa-fw"></i> Destination</div>
                      <!--Given route -->
                      <div class="panel-body">
                        <form class="form-horizontal" method="POST" id="Add_route_form" action="{{ route('admin-route.store') }}">
                                {{ csrf_field() }}         
                                <div class="form-group">
                                      <label for="form" class="col-md-3 control-label"><p>Route</p></label>
                                      <div class="my-form-div col-md-3{{ $errors->has('origin') ? ' has-error' : '' }}">
                                          <input type="text" name="from_place" id="from_place" placeholder="Enter from place" class="form-control" autocomplete="false" value="{{ old('origin') }}" >
                                              <input type="hidden" name="origin" id="origin" class="form-control"value="{{ old('origin') }}">
                                                @if ($errors->has('origin'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('origin') }}</strong>
                                                    </span>
                                                @endif
                                      </div>
                                      <div class="my-form-div col-md-3 {{ $errors->has('destination') ? ' has-error' : '' }}">
                                            <input type="text" name="to_place" id="to_place" placeholder="Enter to place" class="form-control" autocomplete="false" value="{{ old('destination') }}">
                                            <input type="hidden" name="destination" id="destination" class="form-control" value="{{ old('destination') }}">
                                                @if ($errors->has('destination'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('destination') }}</strong>
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
                                      <label for="time" class="col-md-3 control-label"><p>Time (Depend on trafic)</p></label>
                                      <div class="my-form-div col-md-6{{ $errors->has('time') ? ' has-error' : '' }}">
                                          <input id="time" type="text" class="form-control" name="time" value="{{ old('time') }}" placeholder="Ex: 1hr 15m" readonly>
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
                                        <input id="distance" type="text" class="form-control" name="distance" value="{{ old('distance') }}" placeholder="Ex: 10" readonly>
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
                                        <button type="submit" class="btn glyphicon glyphicon-floppy-saved submit-ghost"> Save</button>
                                    </div>
                                </div>
                        </form>
                      </div>  
                    </div>
                      <!-- View -->
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-table fa-fw"></i> Vehicle List</div>
                      <div class="panel-body">
                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover Destination-table" id="Destination_table_list">
                           <thead>
                            <tr>
                              <th>Origin</th>
                             <th>Destination</th>
                             <th>View</th>
                             <th>Delete</th>
                             <th>Edit</th>
                            </tr>
                           </thead>
                           <tbody>
                             @forelse($Route as $route)
                             <tr>
                               <td><p>{{ $route->origin }}</p></td>
                               <td>{{ $route->destination }}</td>
                               <td><a href="{{route('admin-route.show',['id'=>$route->id])}}" class="glyphicon glyphicon-eye-open view-ghost" style=" text-decoration:none;"></a></td>
                               <td>
                                <button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                   <!-- conform delete modal -->
                                {!! Form::open(array('route' => ['admin-route.destroy',$route->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                         @include('message.delete_conformation')
                                {!! Form::close() !!}
                               </td>
                               <td>
                                    <a href="{{route('admin-route.edit',['id'=>$route->id])}}" class="glyphicon glyphicon-pencil edit-ghost" style=" text-decoration:none;"></a>
                               </td>
                             </tr>
                             @empty
                              <tr>
                                <td colspan="5"><center><p style="color: #6F7823;">No destinatione details found</p></center></td>
                              </tr>
                             @endforelse 
                           </tbody>

                         </table>
                          {!! $Route->appends(Request::all())->render() !!}
                       </div>
                      </div>
                    </div>
                   
                </div>
                <!-- Right side -->
                @include('admin.feedback.feedback_index')
                
            </div>
            
</div>



   <!-- Jquery -->
   <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
   <!-- Jquery form validator -->
   <script src="{{asset('js/jquery.validate.js')}}"></script>
   <script src="{{asset('js/additional-methods.js')}}"></script>
   <!-- Hand made Jquery -->
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
        $('#Add_route_form').validate({
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

   // Time out for  <span class="help-block"> </span>
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
