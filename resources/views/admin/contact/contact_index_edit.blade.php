@extends('layouts.app_admin')

@section('title')
Contact Edit
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
                     <!-- Edit -->
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> Contact Edit</div>
                      <div class="panel-body">
                        {!! Form::model($ContactUs,array('route' => ['admin-contact.update',$ContactUs->id],'method'=>'PUT','class'=>'form-horizontal','id'=>'Update_contact_edit')) !!}
                          {{ csrf_field() }}
                      
                        <div class="form-group{{ $errors->has('office') ? ' has-error' : '' }}">
                            <label for="office" class="col-md-4 control-label"><p>Office</p></label>

                            <div class="col-md-6">
                                {!! Form::text('office',null,['id'=>'office','class'=>'form-control','placeholder'=>'Ex: Hello']) !!}

                                @if ($errors->has('office'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('office') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label"><p>Address</p></label>

                            <div class="col-md-6">
                                {!! Form::textarea('address',null,['id'=>'address','class'=>'form-control textarea','placeholder'=>'Ex: Hello']) !!}
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cell') ? ' has-error' : '' }}">
                            <label for="cell" class="col-md-4 control-label"><p>Office Cell</p></label>

                            <div class="col-md-6">
                                {!! Form::text('cell',null,['id'=>'cell','class'=>'form-control','placeholder'=>'Ex: +88XXXXXXXXXX,+88XXXXXXXX']) !!}
                                @if ($errors->has('cell'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cell') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label"><p>Email</p></label>

                            <div class="col-md-6">
                                {!! Form::email('email',null,['id'=>'email','class'=>'form-control','placeholder'=>'Ex: farzan@gmail.com']) !!}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
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
        $('#Update_contact_edit').validate({
        rules:{
        email:{
          required:true,
          maxlength:50,
          email:true
        },
        office:{
          required:true,
          maxlength:100,
          latter_with_space:true
        },
        address:{
          required:true
        },
        cell:{
          required:true,
          maxlength:112,
          mobile_no:true
        }

      },
      messages:{
        email:{
          required:"This is required.",
          email:"Enter a valid email."
        },
        office:{
          required:"This is required.",
          maxlength:"Enter a max char 100."
        },
        address:{
          required:"This is required."
        },
        cell:{
          required:"This is required."
        }

        }
  });

  // Allow any latter with space method
   jQuery.validator.addMethod("latter_with_space", function(value, element) {
  
    return this.optional( element ) || /^[A-Za-z ]*$/.test( value );
    }, 'Only Latter characters with space are allow.');

   // Allow Mobile no allow method
   jQuery.validator.addMethod("mobile_no", function(value, element) {
  
    return this.optional( element ) || /^[0-9,+]*$/.test( value );
    }, 'Mobile no allow.');


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
