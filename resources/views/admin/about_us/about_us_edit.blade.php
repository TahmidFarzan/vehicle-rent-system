@extends('layouts.app_admin')

@section('title')
VSR About us
@endsection

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Admin</h1>
                    <!-- Message -->
                     @include('message.message_block')
                </div>
                
            </div>
            
            <div class="row">
                <!-- Right side -->
                <div class="col-lg-9">
                   <!-- Add -->
                   <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> About us info edit</div>
                      <div class="panel-body">
                        {!! Form::model($AboutUs,array('route' => ['admin-about_us.update',$AboutUs->id],'method'=>'PUT','class'=>'form-horizontal','id'=>'About_us_form')) !!}
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                 <label for="description" class="col-md-2 control-label"><p>Description</p></label>
                                  <div class="col-md-9 my-form-div">
                                     <textarea id="description" name="description" class="form-control textarea" rows="7">{{$AboutUs->description}}</textarea>
                                         <div class="{{ $errors->has('description') ? ' has-error' : '' }}">
                                               @if ($errors->has('description'))
                                                <span class="help-block">
                                                   <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                              @endif
                                         </div>
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
        $('#About_us_form').validate({
          rules:{
             descriptaion:{
             
            }
          },
          messages:{
             descriptaion:{
             
            }
            }
        });
// Time out for  <div class="alert "> </div>
  setTimeout(function(){

        $("div.alert").remove();
    }, 3500 );

  
</script>


@endsection
