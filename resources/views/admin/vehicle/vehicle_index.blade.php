@extends('layouts.app_admin')

@section('title')
VRS Vehicle
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
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> Vehicle info</div>
                      <div class="panel-body">
                         <form class="form-horizontal" method="POST" name="Add vehicle form" id="Add_vehicle_form" action="{{ route('admin-vehicle.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
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

                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                               <label for="type" class="col-md-4 control-label"><p>Type</p></label>

                                <div class="col-md-6">
                                   {{ Form::select('type',$VehicleType, null, ['placeholder' => 'Please select type','class'=>'form-control','id'=>'type']) }}

                                   @if ($errors->has('type'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('type') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>
                        
                             <div class="form-group{{ $errors->has('licence_no') ? ' has-error' : '' }}">
                               <label for="licence_no" class="col-md-4 control-label"><p>Licence no</p></label>

                                <div class="col-md-6">
                                   <input type="text" name="licence_no" class="form-control" placeholder="Ex: 10" value="{{ old('licence_no') }}">

                                   @if ($errors->has('licence_no'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('licence_no') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>

                            <div class="form-group{{ $errors->has('seat') ? ' has-error' : '' }}">
                               <label for="seat" class="col-md-4 control-label"><p>Seat</p></label>

                                <div class="col-md-6">
                                   <input type="number" name="seat" class="form-control" placeholder="Ex: 10" value="{{ old('seat') }}" max="60" min="0">

                                   @if ($errors->has('seat'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('seat') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                 <label for="image" class="col-md-4 control-label"><p>Image(450x250)</p></label>

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
                                 <label for="image_preview" class="col-md-4 control-label"><p></p></label>

                                  <div class="col-md-6">
                                     <img name="image_preview" id="image_preview" class="thumbnail">

                                    </div>
                               </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn submit-ghost">
                                     Submit
                                   </button>
                               </div>
                             </div>
                          </form>
                      </div>    
                   </div>
                  <!-- List -->
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-dashboard fa-fw"></i>Vehicle List</div>
                      <div class="panel-body">
                        <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                                 <tr>
                                    <th>Vehicle name</th>
                                    <th>Vehicle type</th>
                                    <th>Show</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                 </tr>
                             </thead>
                             <tbody>
                               @forelse($VehicleDetail as $vd)
                               <tr>
                               <td><b>{{ $vd->name }}</b></td>
                               <td>{{ $vd->vehicle_type->name }}</td>
                               <td><a href="{{route('admin-vehicle.show',['id'=>$vd->id])}}" class="glyphicon glyphicon-eye-open view-ghost" style=" text-decoration:none;"></a></td>
                                <td><button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                  <!-- conform delete modal -->
                                  {!! Form::open(array('route' => ['admin-vehicle.destroy',$vd->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                       @include('message.delete_conformation')
                                  {!! Form::close() !!}
                                 </td>
                                 <td>
                                  <a href="{{route('admin-vehicle.edit',['id'=>$vd->id])}}" class="glyphicon glyphicon-pencil edit-ghost" style=" text-decoration:none;"></a>
                                  </td>
                                 </tr>
                                @empty
                                   <tr class="empty"><td colspan="5"><p>No vehicle added.</p></td></tr>
                                @endforelse
                             </tbody>
                           </table>
                            {!! $VehicleDetail->appends(Request::all())->render() !!}
                        </div>
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
    // Form validate 
        $('#Add_vehicle_form').validate({
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
              required:true,
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
                 required:'Image is required.',
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
