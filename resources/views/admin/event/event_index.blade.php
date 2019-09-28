@extends('layouts.app_admin')

@section('title')
VSR Event
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
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> Event info</div>
                      <div class="panel-body">
                         <form class="form-horizontal" method="POST" id="Add_event_form" action="{{ route('admin-event.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                             <div class="form-group">
                              <label for="start_time" class="col-md-2 control-label"><p>Start</p></label>

                                <div class="col-md-4 my-form-div">
                                   <input type="time" name="start_time" class="form-control" placeholder="Ex: 10:10 AM" value="{{ old('start_time') }}" id="start_time">
                                     <div class="{{ $errors->has('start_time') ? ' has-error' : '' }}">
                                          @if ($errors->has('start_time'))
                                             <span class="help-block">
                                                <strong>{{ $errors->first('start_time') }}</strong>
                                             </span>
                                          @endif
                                     
                                     </div>
                                  </div>
                                  
                                 <div class="col-md-5 my-form-div" id="start_date_div">
                                   <input type="date" name="start_date" class="form-control" placeholder="Ex: 2018-03-06" value="{{ old('start_date') }}" id="start_date">

                                       <div class="{{ $errors->has('start_date') ? ' has-error' : '' }}">
                                          @if ($errors->has('start_date'))
                                             <span class="help-block">
                                                <strong>{{ $errors->first('start_date') }}</strong>
                                             </span>
                                          @endif
                                       </div>
                                  </div>
                               
                            </div> 

                            <div class="form-group">
                              <label for="end_time" class="col-md-2 control-label"><p>End</p></label>

                                <div class="col-md-4 my-form-div">
                                   <input type="time" name="end_time" class="form-control" placeholder="Ex: 10:10 AM" value="{{ old('end_time') }}" id="end_time">
                                     <div class="{{ $errors->has('end_time') ? ' has-error' : '' }}">
                                          @if ($errors->has('end_time'))
                                             <span class="help-block">
                                               <strong>{{ $errors->first('end_time') }}</strong>
                                            </span>
                                          @endif
                                     </div>
                                  </div>
                                  
                                 <div class="col-md-5 my-form-div" id="end_date_div">
                                   <input type="date" name="end_date" class="form-control" placeholder="Ex: 2018-03-06" value="{{ old('end_date') }}" id="end_date">
                                       <div class="{{ $errors->has('end_date') ? ' has-error' : '' }}">
                                           @if ($errors->has('end_date'))
                                             <span class="help-block">
                                                 <strong>{{ $errors->first('end_date') }}</strong>
                                             </span>
                                           @endif
                                       </div>
                                  </div> 
                            </div> 

                            <div class="form-group">
                               <label for="name" class="col-md-2 control-label"><p>Event name</p></label>

                                <div class="col-md-9 my-form-div">
                                  <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ex: Farzan">
                                     <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                               <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                     </div>
                                  </div>
                            </div>

                            <div class="form-group">
                               <label for="type" class="col-md-2 control-label "><p>Type</p></label>

                                <div class="col-md-9  my-form-div">
                                   {{ Form::select('type',$EventType, null, ['placeholder' => 'Please select type','class'=>'form-control','id'=>'type']) }}
                                       <div class="{{ $errors->has('type') ? ' has-error' : '' }}">
                                          @if ($errors->has('type'))
                                            <span class="help-block">
                                              <strong>{{ $errors->first('type') }}</strong>
                                            </span>
                                          @endif
                                       </div>
                                  </div>
                            </div>

                            <div class="form-group">
                               <label for="address" class="col-md-2 control-label"><p>Event address</p></label>

                                <div class="col-md-9 my-form-div">
                                  <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="Ex: Farzan">
                                     <div class="{{ $errors->has('address') ? ' has-error' : '' }}">
                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                               <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                     </div>
                                  </div>
                            </div>

                            <div class="form-group">
                               <label for="map" class="col-md-2 control-label"><p>Map</p></label>

                                <div class="col-md-9 my-form-div">
                                  <input id="map" type="url" class="form-control" name="map" value="{{ old('map') }}" placeholder="Ex: googl.com">
                                     <div class="{{ $errors->has('map') ? ' has-error' : '' }}">
                                        @if ($errors->has('map'))
                                            <span class="help-block">
                                               <strong>{{ $errors->first('map') }}</strong>
                                            </span>
                                        @endif
                                     </div>
                                  </div>
                            </div>

                             <div class="form-group">
                                 <label for="descriptaion" class="col-md-2 control-label"><p>Descriptaion</p></label>
                                  <div class="col-md-9 my-form-div">
                                     <textarea id="descriptaion" name="descriptaion" class="form-control textarea" placeholder="Helo" rows="7"></textarea>
                                         <div class="{{ $errors->has('descriptaion') ? ' has-error' : '' }}">
                                               @if ($errors->has('descriptaion'))
                                                <span class="help-block">
                                                   <strong>{{ $errors->first('descriptaion') }}</strong>
                                                </span>
                                              @endif
                                         </div>
                                    </div>
                            </div>

                            <div class="form-group">
                                 <label for="organizar" class="col-md-2 control-label"><p>Organizar</p></label>
                                  <div class="col-md-9 my-form-div">
                                     <textarea id="organizar" name="organizar" class="form-control textarea" placeholder="Helo" rows="7"></textarea>
                                          <div class="{{ $errors->has('organizar') ? ' has-error' : '' }}">
                                              @if ($errors->has('organizar'))
                                                <span class="help-block">
                                                  <strong>{{ $errors->first('organizar') }}</strong>
                                                </span>
                                              @endif
                                          </div>
                                    </div>
                            </div>

                            <div class="form-group">
                                 <label for="patner" class="col-md-2 control-label"><p>Patner</p></label>

                                  <div class="col-md-9 my-form-div">
                                     <textarea id="patner" name="patner" class="form-control textarea" placeholder="Helo" rows="7"></textarea>
                                        <div class="{{ $errors->has('patner') ? ' has-error' : '' }}">
                                                @if ($errors->has('patner'))
                                                 <span class="help-block">
                                                   <strong>{{ $errors->first('patner') }}</strong>
                                                 </span>
                                                @endif
                                        </div>
                                    </div>
                            </div>
                            
                            <div class="form-group">
                                 <label for="image" class="col-md-2 control-label"><p>Image</p></label>

                                  <div class="col-md-9 my-form-div">
                                     <input id="image" type="file" name="image" class="form-control">
                                         <div class="{{ $errors->has('image') ? ' has-error' : '' }}">
                                            @if ($errors->has('image'))
                                               <span class="help-block">
                                                   <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @endif
                                         </div>
                                    </div>
                            </div>

                             <div class="form-group" id="image_preview_div">
                                 <label for="image_preview" class="col-md-2 control-label"><p></p></label>

                                  <div class="col-md-9">
                                     <img name="image_preview" id="image_preview" class="thumbnail">

                                    </div>
                               </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                   <center><button type="submit" class="btn submit-ghost" id="submit">
                                     Submit
                                   </button></center>
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
                                    <th>Event name</th>
                                    <th>Event type</th>
                                    <th>Show</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                 </tr>
                             </thead>
                             <tbody>
                               @forelse($EventDetail as $ed)
                               <tr>
                               <td><b>{{ $ed->name }}</b></td>
                               <td>{{ $ed->event_type->name }}</td>
                               <td><a href="{{route('admin-event.show',['id'=>$ed->id])}}" class="glyphicon glyphicon-eye-open view-ghost" style=" text-decoration:none;"></a></td>
                                <td><button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                  <!-- conform delete modal -->
                                  {!! Form::open(array('route' => ['admin-event.destroy',$ed->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                       @include('message.delete_conformation')
                                  {!! Form::close() !!}
                                 </td>
                                 <td>
                                  <a href="{{route('admin-event.edit',['id'=>$ed->id])}}" class="glyphicon glyphicon-pencil edit-ghost" style=" text-decoration:none;"></a>
                                  </td>
                                 </tr>
                                @empty
                                   <tr class="empty"><td colspan="5"><p>No vehicle added.</p></td></tr>
                                @endforelse
                             </tbody>
                           </table>
                            {!! $EventDetail->appends(Request::all())->render() !!}
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
 <!-- Jquery Rich text editor -->
 <script src="{{asset('tinymce/tinymce.min.js')}}"></script>

<script type="text/javascript">
  //Call rich text editor
tinymce.init({
  selector: 'textarea',
  height: 300,
  menubar: true,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code',
    'insertdatetime media table contextmenu paste code help wordcount emoticons pagebreak'
  ],
  toolbar: 'insert | table | undo redo | emoticons | pagebreak | formatselect | block | bold italic strikethrough underline forecolor backcolor | searchreplace | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | preview | paste | code',

  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css']
});

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
        $('#Add_event_form').validate({
          rules:{
            name:{
              required:true,
              maxlength:100,
              alphanumeric_with_space_dash_hypan:true
            },
            type:{
              required:true,
              maxlength:10,
              number:true,
              min:1
            },
            address:{
              required:true
            },
            map:{
              required:true,
              url:true
            },
           start_time:{
              required:true,
              time:true
             },
           start_date:{
              required:true,
              date:true
            },
             end_time:{
              required:true,
              time:true
             },
           end_date:{
              required:true,
              date:true
            },
             descriptaion:{
             
            },
            organizar:{
             
            },
             patner:{
             
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
             address:{
              required:"Address is required.",
             },
             map:{
              required:"Event map is required.",
             },
              start_time:{
              required:"Start time is required.",
              time:"Time format must be 24hr."
             },
           start_date:{
              required:"Start date is required.",
              date:"Date format must (YYYY-MM-DD)."
            },
             end_time:{
              required:"End time is required",
              time:"Time format must be 24hr"
             },
           end_date:{
              required:"End date is required",
              date:"Date format must (YYYY-MM-DD)."
            },
             descriptaion:{
             
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

// Time out for  <div class="alert "> </div>
  setTimeout(function(){

        $("div.alert").remove();
    }, 3500 );
// Time out for  <span class="ahelp-block "> </span>
   setTimeout(function(){

        $("span.help-block").remove();
    }, 3500 );
</script>


@endsection
