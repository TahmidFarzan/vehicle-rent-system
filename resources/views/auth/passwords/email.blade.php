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
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}" id="User_password_reset_link">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label"><p>E-Mail Address</p></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Ex: farzan@email.com">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn reset-ghost">
                                    Send
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
     $("#User_password_reset_link").validate({
      rules:{
        "email":{
          required:true,
          email:true
        }
      },
      messages:{
        "email":{
          required:"This is required.",
          email:"Enter a valid email."
        }
        }
    });

      // Time out for  <span class="help-block"> </span>
  setTimeout(function(){

        $("div.alert").remove();
   }, 2500 );
</script>
@endsection
