@extends('layouts.app_admin')

@section('title')
VRS Vehicle Edit
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
                <div class="col-lg-8">
                     <!-- Edit-->
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> Vehicle Edit</div>
                      <div class="panel-body">
                        {!! Form::model($VehicleDetail,array('route' => ['admin-vehicle.update',$VehicleDetail->id],'method'=>'PUT','class'=>'form-horizontal','id'=>'update_vehicle_detail','enctype'=>'multipart/form-data')) !!}
                          {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label"><p style="float: left;">Name</p></label>

                            <div class="col-md-6">
                                {!! Form::text('name',null,['id'=>'name','class'=>'form-control']) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label"><p style="float: left;">Type</p></label>

                            <div class="col-md-6">
                              {{ Form::select('type',$VehicleType, $VehicleDetail->type_id, ['placeholder' => 'Please select type','class'=>'form-control','id'=>'type']) }}
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('seat') ? ' has-error' : '' }}">
                            <label for="seat" class="col-md-4 control-label"><p style="float: left;">Seat amount</p></label>

                            <div class="col-md-6">
                                {!! Form::text('seat',null,['id'=>'seat','class'=>'form-control','min'=>'1']) !!}

                                @if ($errors->has('seat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('seat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('licence_no') ? ' has-error' : '' }}">
                            <label for="licence_no" class="col-md-4 control-label"><p style="float: left;">Licence no</p></label>

                            <div class="col-md-6">
                                {!! Form::text('licence_no',null,['id'=>'seat','class'=>'form-control']) !!}

                                @if ($errors->has('licence_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('licence_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label"><p style="float: left;">Image(450x250)</p></label>

                            <div class="col-md-6">
                                <input id="image" type="file" name="image" class="form-control">
                                      @if ($errors->has('image'))
                                       <span class="help-block">
                                          <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                       @endif
                            </div>
                        </div>

                        <div class="form-group" id="image_preview_div">
                                 <label for="address" class="col-md-4 control-label"><p></p></label>

                                  <div class="col-md-6">
                                     <img name="image_preview" id="image_preview" class="thumbnail">

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
     // Onload 
   

    // Preview image
      $("#image_preview_div").hide();
      document.getElementById("image").onchange = function () {
         var reader = new FileReader();
         reader.onload = function(e) {
          $("#image_preview_div").show();
             document.getElementById("image_preview").src = e.target.result;
             }
         reader.readAsDataURL(this.files[0]);
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
           // Add_vehicle_form validate 
        $('#update_vehicle_detail').validate({
         rules:{
            name:{
              required:true,
              maxlength:50,
              alphanumeric_with_space_dash_hypan:true
            },
            type:{
              required:true,
              maxlength:10,
              number:true,
              min:1
            },
           seat:{
              required:true,
              maxlength:50,
              number:true
             },
           licence_no:{
              required:true,
              maxlength:50,
              licence_no_validation:true
            },
            image:{
              extension: "jpg|png|jpeg"
            }
          },
          messages:{
             name:{
              required:"Name is required.",
              maxlength:"Max length 10"
             },
             type:{
               required:"Type is required.",
               maxlength:"Max length 10"
             },
              seat:{
                required:"Seat amount is required.",
                maxlength:"Max length 50"
               },
              licence_no:{
                required:"Licence no is required.",
                maxlength:"Max length 50"
               },
               image:{
                 extension: "Only Image allow."
            }
            }
        });

         // Allow any alphanumeric with spacebar and dash,hypen characters method
          jQuery.validator.addMethod("alphanumeric_with_space_dash_hypan", function(value, element) {
              return this.optional( element ) || /^[A-Za-z0-9-_ ]+$/.test( value );
          }, 'Alphanumeric characters with space dash or hypan are allow.');

  // Allow any alphanumeric with space and colon characters method
        jQuery.validator.addMethod("licence_no_validation", function(value, element) {
         return this.optional( element ) || /^[A-Za-z0-9-: ]+$/.test( value );
         }, 'Alphanumeric characters with space : - are allow.');    
// Time out for  <div class="alert "> </div>
  setTimeout(function(){

        $("div.alert").remove();
    }, 3500 );

  // Time out for  <span class="help-block"> </div>
  setTimeout(function(){

        $("span.help-block").remove();
    }, 3500 );

 
  </script>
@endsection
