@extends('layouts.app')

@section('title')
Contact us
@endsection

@section('content')
<div class="row">
        <div class="col-md-10 col-md-offset-1">
                <div class="panel-body">@include('message.message_block')</div>
            <!-- Contact us -->
            <div class="col-md-7">
                 <div class="panel panel-default">
                      <div class="panel-heading">Contact</div>
                        <div class="panel-body">
                           <div class="table-responsive">
                               <table class="table table-bordered ">
                                <thead>
                                    <tr>
                                      <th><center>Office/branch</center></th>
                                      <th><center>Information</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ContactUs as $cu)
                                    <tr>
                                        <td>{{$cu->office}}</td>
                                        <td>
                                            <table class="table table-bordered">
                                                
                                                <tr>
                                                   <td>Address</td>
                                                   <td>:</td>
                                                   <td>{{$cu->address}}</td>
                                                </tr>
                                                <tr>
                                                   <td>Email</td>
                                                   <td>:</td>
                                                   <td>{{$cu->email}}</td>
                                                </tr>
                                                <tr>
                                                   <td>Cell no</td>
                                                   <td>:</td>
                                                   <td>{{$cu->cell}}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    @empty
                                      <tr class="empty">
                                            <td colspan="2"><p>No Contact info added.</p></td>
                                      </tr>
                                    @endforelse   
                                </tbody>
                               </table>
                           </div>
                        </div>
                 </div>
            </div>
            <!-- Feedback us -->
            <div class="col-md-5">
                 <div class="panel panel-default">
                      <div class="panel-heading">Feed back</div>
                        <div class="panel-body">
                          <form class="form-horizontal" method="POST" id="Add_feedback_form" action="{{ route('feedback-us.store') }}">
                             {{ csrf_field() }}

                             @if (Auth::guest())
                             <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                   <label for="name" class="col-md-5 control-label"><p>Your name</p>:</label>
                                   <div class="col-md-6">
                                      <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ex: Farzan">
                                         @if ($errors->has('name'))
                                           <span class="help-block">
                                             <strong>{{ $errors->first('name') }}</strong>
                                           </span>
                                         @endif
                                   </div>
                             </div>
                             <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                 <label for="email" class="col-md-5 control-label"><p>Your email</p>:</label>
                                 <div class="col-md-6">
                                     <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Ex: xx@xx.com">
                                       @if ($errors->has('email'))
                                           <span class="help-block">
                                             <strong>{{ $errors->first('email') }}</strong>
                                           </span>
                                        @endif
                                 </div>
                             </div>
                             @endif

                            @auth('web')
                             <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                   <label for="name" class="col-md-5 control-label"><p>Your name</p>:</label>
                                   <div class="col-md-6">
                                      <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="Ex: Farzan" readonly>
                                         @if ($errors->has('name'))
                                           <span class="help-block">
                                             <strong>{{ $errors->first('name') }}</strong>
                                           </span>
                                         @endif
                                   </div>
                             </div>
                             <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                 <label for="email" class="col-md-5 control-label"><p>Your email</p>:</label>
                                 <div class="col-md-6">
                                     <input id="email" type="email" class="form-control" name="email" value=" {{ Auth::user()->email }} " placeholder="Ex: xx@xx.com" readonly>
                                       @if ($errors->has('email'))
                                           <span class="help-block">
                                             <strong>{{ $errors->first('email') }}</strong>
                                           </span>
                                        @endif
                                 </div>
                             </div>
                             @endauth

                             <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                 <label for="message" class="col-md-5 control-label"><p>Your message</p>:</label>
                                  <div class="col-md-6">
                                     <textarea id="message" class="form-control textarea" name="message" placeholder="Ex: My .......">{{ old('message') }}</textarea>
                                         @if ($errors->has('message'))
                                             <span class="help-block">
                                               <strong>{{ $errors->first('message') }}</strong>
                                             </span>
                                         @endif
                                  </div>
                             </div>
                              <div class="form-group">
                                 <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="glyphicon glyphicon-send btn submit-ghost">
                                    Send
                                   </button>
                                 </div>
                               </div>
                          </form>
                        </div>
                 </div>
            </div>
        </div>
</div>

 <!-- Jquery-->
   <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
   <!-- Jquery validator -->
   <script src="{{ asset('js/jquery.validate.js') }}"></script>
   <script src="{{ asset('js/additional-methods.js') }}"></script>
   <!-- Hand made Jquery -->
   <script type="text/javascript">

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

      //Form validation
    $("#Add_feedback_form").validate({
      rules:{
         name:{
          required:true,
          maxlength:100,
          latter_with_space:true
        },
        email:{
          required:true,
          maxlength:50,
          email:true
        },
        message:{
          required:true
        }

      },
      messages:{
        name:{
          required:"This is required.",
          maxlength:"Enter a max char 100."
        },
        email:{
          required:"This is required.",
          email:"Enter a valid email."
        },
        message:{
          required:"This is required."
        }

        }
  });

  // Allow any latter with space method
   jQuery.validator.addMethod("latter_with_space", function(value, element) {
  
    return this.optional( element ) || /^[A-Za-z ]*$/.test( value );
    }, 'Only Latter characters with space are allow.');

    // Time out for  <span class="help-block"> </span>
  setTimeout(function(){

        $("span.help-block").remove();
   }, 3500 );

      // Time out for  <div class="alert"> </span>
  setTimeout(function(){

        $("div.alert").remove();
   }, 3500 );
  
   </script>

@endsection
