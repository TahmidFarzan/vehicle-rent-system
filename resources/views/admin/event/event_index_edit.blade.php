@extends('layouts.app_admin')

@section('title')
VSR Event
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
                     <!-- Edit-->
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> Event Edit</div>
                      <div class="panel-body">
                        {!! Form::model($EventDetail,array('route' => ['admin-event.update',$EventDetail->id],'method'=>'PUT','class'=>'form-horizontal','id'=>'Update_event_form','enctype'=>'multipart/form-data')) !!}
                          {{ csrf_field() }}
                          <div class="form-group">
                              <label for="start_time" class="col-md-2 control-label"><p>Start</p></label>

                                <div class="col-md-4 my-form-div">
                                   <input type="time" name="start_time" class="form-control" placeholder="Ex: 10:10 AM" value="{{ $EventDetail->start_time }}" id="start_time">
                                    <div class="{{ $errors->has('start_time') ? ' has-error' : '' }}">
                                          @if ($errors->has('start_time'))
                                             <span class="help-block">
                                                <strong>{{ $errors->first('start_time') }}</strong>
                                             </span>
                                          @endif
                                     
                                     </div>
                                  </div>
                                  
                                 <div class="col-md-5 my-form-div" id="start_date_div">
                                   <input type="date" name="start_date" class="form-control" placeholder="Ex: 2018-03-06" value="{{ $EventDetail->start_date }}" id="start_date">

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
                                   <input type="time" name="end_time" class="form-control" placeholder="Ex: 10:10 AM" value="{{ $EventDetail->end_time }}" id="end_time">

                                   <div class="{{ $errors->has('end_time') ? ' has-error' : '' }}">
                                          @if ($errors->has('end_time'))
                                             <span class="help-block">
                                               <strong>{{ $errors->first('end_time') }}</strong>
                                            </span>
                                          @endif
                                     </div>
                                  </div>
                                  
                                 <div class="col-md-5 my-form-div" id="end_date_div">
                                   <input type="date" name="end_date" class="form-control" placeholder="Ex: 2018-03-06" value="{{ $EventDetail->end_date }}" id="end_date">
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
                                  <input id="name" type="text" class="form-control" name="name" value="{{ $EventDetail->name }}" placeholder="Ex: Farzan">

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
                                   {{ Form::select('type',$EventType, $EventDetail->event_type_id, ['placeholder' => 'Please select type','class'=>'form-control','id'=>'type']) }}

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
                                  <input id="address" type="text" class="form-control" name="address" value="{{ $EventDetail->address }}" placeholder="Ex: Farzan">
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
                                  <input id="map" type="url" class="form-control" name="map" value="{{ $EventDetail->map }}" placeholder="Ex: googl.com">
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

                                     <textarea id="descriptaion" name="descriptaion" class="form-control textarea" placeholder="Helo" rows="7">
                                       {{ $EventDetail->descriptaion }}
                                     </textarea>

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
                                     <textarea id="organizar" name="organizar" class="form-control textarea" placeholder="Helo" rows="7">
                                       {{ $EventDetail->organizar }}
                                     </textarea>
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
                                     <textarea id="patner" name="patner" class="form-control textarea" placeholder="Helo" rows="7">
                                       {{ $EventDetail->patner }}
                                     </textarea>
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
                                <div class="col-md-9 col-md-offset-4">
                                    <button type="submit" class="btn submit-ghost" id="submit">
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
        $('Update_event_form').validate({
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

  
    
</script>

@endsection
