@extends('layouts.app_admin')

@section('title')
VRS Slider Edit
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
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> Slider Edit</div>
                      <div class="panel-body">
                        {!! Form::model($HomeSlider,array('route' => ['admin-home_slider.update',$HomeSlider->id],'method'=>'PUT','class'=>'form-horizontal','id'=>'Update_home_slider_form','enctype'=>'multipart/form-data')) !!}
                          {{ csrf_field() }}
                          <div class="form-group{{ $errors->has('slider_sequence') ? ' has-error' : '' }}">
                               <label for="slider_sequence" class="col-md-4 control-label"><p>Slider sequence</p></label>

                                <div class="col-md-6">
                                  <input id="slider_sequence" type="number" class="form-control" name="slider_sequence" value="{{ $HomeSlider->slider_sequence}}" placeholder="Ex: 1" min="1">

                                   @if ($errors->has('slider_sequence'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('slider_sequence') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>
                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="url" class="col-md-4 control-label"><p style="float: left;">Slider url</p></label>

                            <div class="col-md-6">
                                {!! Form::url('url',$HomeSlider->slider_url,['id'=>'url','class'=>'form-control','placeholder'=>'Ex: www.google.com']) !!}

                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('alt_text') ? ' has-error' : '' }}">
                               <label for="alt_text" class="col-md-4 control-label"><p>Imae alt text</p></label>

                                <div class="col-md-6">
                                  <input id="alt_text" type="text" class="form-control" name="alt_text" value="{{$HomeSlider->slider_alt}}" placeholder="Ex: Hello">

                                   @if ($errors->has('alt_text'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('alt_text') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>

                         <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label"><p style="float: left;">Image(450x450)</p></label>

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
        $('#Update_home_slider_form').validate({
          rules:{
            url:{
              required:true,
              url:true
            },
            slider_sequence:{
              required:true,
              number:true,
              maxlength:10,
            },
             alt_text:{
              required:true,
              maxlength:100,
              latter_with_space_fullstop:true
            },
            image:{
              extension: "jpg|png|jpeg"
            }
          },
          messages:{
             url:{
              required:"Name is required.",
              url:"Only url allow."
             },
              slider_sequence:{
              required:"Image sequesce is required.",
              number:"Must be a number"
            },
              alt_text:{
               required:"Image alt text is required.",
               maxlength:"Max char 100.",
            },
            image:{
                 extension: "Only Image allow."
            }
            }
        });

         // Allow any latter with spacebar and . characters method
          jQuery.validator.addMethod("latter_with_space_fullstop", function(value, element) {
              return this.optional( element ) || /^[A-Za-z .]+$/.test( value );
          }, 'Latter characters with space fullstop are allow.');

  setTimeout(function(){

        $("div.alert").remove();
    }, 3500 );

  // Time out for  <span class="help-block"> </div>
  setTimeout(function(){

        $("span.help-block").remove();
    }, 3500 );
    
</script>
@endsection
