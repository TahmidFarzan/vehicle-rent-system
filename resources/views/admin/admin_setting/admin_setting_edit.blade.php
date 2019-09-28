@extends('layouts.app_admin')

@section('title')
{{$Admin->name}} Setting
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
                  <!-- Edit -->
                   <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> VRS admin info</div>
                      <div class="panel-body">
                         {!! Form::model($Admin,array('route' => ['admin_setting.update',$Admin->id],'method'=>'PUT','class'=>'form-horizontal','id'=>'Update_admin_setting')) !!}
                               {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label"><p>Name</p></label>

                                   <div class="col-md-6">
                                      <input id="name" type="text" class="form-control" name="name" value="{{ $Admin->name }}" placeholder="Ex: Farzan">

                                       @if ($errors->has('name'))
                                           <span class="help-block">
                                              <strong>{{ $errors->first('name') }}</strong>
                                          </span>
                                      @endif
                                   </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label"><p>E-Mail Address</p></label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $Admin->email }}" placeholder="Ex: farzan@email.com">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                               <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                 <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                                    <label for="old_password" class="col-md-4 control-label"><p> Old Password</p></label>

                                     <div class="col-md-6">
                                           <input id="old_password" type="password" class="form-control" name="old_password" placeholder="Ex: XXXXXX">

                                           @if ($errors->has('old_password'))
                                             <span class="help-block">
                                                   <strong>{{ $errors->first('old_password') }}</strong>
                                              </span>
                                          @endif
                                      </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label"><p>New Password</p></label>

                                     <div class="col-md-6">
                                           <input id="password" type="password" class="form-control" name="password" placeholder="Ex: XXXXXX">

                                           @if ($errors->has('password'))
                                             <span class="help-block">
                                                   <strong>{{ $errors->first('password') }}</strong>
                                              </span>
                                          @endif
                                      </div>
                                </div>

                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password_confirmation" class="col-md-4 control-label"><p>Confirm Password</p></label>

                                    <div class="col-md-6">
                                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Ex: XXXXXX">

                                        @if ($errors->has('password_confirmation'))
                                             <span class="help-block">
                                                 <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                       @endif
                                   </div>
                               </div>                            
                               <div class="form-group">
                                   <div class="col-md-6 col-md-offset-4">
                                       <button type="submit" class="btn submit-ghost">Update</button>
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
    $('#Update_admin_setting').validate({
      rules:{
        "name":{
          required:true,
          maxlength:50,
          latter_with_space:true
        },
        "email":{
          required:true,
          email:true
        },
        "password":{
          required:true,
          minlength:6
        },
        "old_password":{
          required:true,
          minlength:6
        },
        "password_confirmation":{
          required:true,
          minlength:6,
          equalTo:"#password"
         } 
      },
      messages:{
            "password_confirmation":{
                required:"This is required.",
                minlength:"Min length 6.",
                equalTo:"Password must be same as above."
              },
      }
        });

  // Allow any latter with space characters method
          jQuery.validator.addMethod("latter_with_space", function(value, element) {
              return this.optional( element ) || /^[A-Za-z ]+$/.test( value );
          }, 'Alphanumeric characters with space dash or hypan are allow.');

  // Allow any mobile method
        jQuery.validator.addMethod("mobile", function(value, element) {
         return this.optional( element ) || /^[0-9+,-]+$/.test( value );
         }, 'Mobile no are allow.');    
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
