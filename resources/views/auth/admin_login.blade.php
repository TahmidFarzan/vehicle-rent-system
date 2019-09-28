@extends('layouts.app')

@section('title')
Admin Log in
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
           @include('message.message_block')
            <div class="panel panel-default">
                <div class="panel-heading">Admin Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('admin.login.submit') }}" id="Admin_login">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Ex: farzan@email.com">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Ex: XXXXXX">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn login-ghost">
                                    Login
                                </button>
                                <p>Forgot your<a class="btn btn-link" href="{{ route('admin.reset') }}"> Password?</a></p>
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
     $("#Admin_login").validate({
      rules:{
        "email":{
          required:true,
          email:true
        },
        "password":{
          required:true,
          minlength:6
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
        } 
        }
    });
         // Time out for  <div class="alert"> </span>
  setTimeout(function(){

        $("div.alert").remove();
   }, 3500 );
   </script> 
@endsection
