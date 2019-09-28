@extends('layouts.app')

@section('title')
Reset
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Reset Password</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}" id="User_password_reset_form">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label"><p>E-Mail Address</p></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Ex: farzan@email.com">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label"><p>Password</p></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Ex:XXXXXX">

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
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Ex:XXXXXX">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn reset-ghost">
                                    Reset
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

   <!-- Bootstrap jquery-->
   <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
   <!-- Jquery validator -->
   <script src="{{ asset('js/jquery.validate.js') }}"></script>
   <script src="{{ asset('js/additional-methods.js') }}"></script>

   <!-- Jquery by own-->
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
      //User login form validation
    $("#User_password_reset_form").validate({
      rules:{
        "email":{
          required:true,
          email:true
        },
        "password":{
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
        "email":{
          required:"This is required.",
          email:"Enter a valid email."
        },
        "password":{
          required:"This is required.",
          minlength:"Min length 6."
        },
        "password_confirmation":{
          required:"This is required.",
          minlength:"Min length 6.",
          equalTo:"Password must be same as above."
        },

        }
  });

     // Time out for  <span class="help-block"> </span>
  setTimeout(function(){

        $("span.help-block").remove();
   }, 2500 );
   </script> 
@endsection
