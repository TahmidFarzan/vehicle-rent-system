@extends('layouts.app_admin')

@section('title')
Contact
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
                    <!-- Add   -->
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-dashboard fa-fw"></i> Contact</div>
                      <div class="panel-body">
                          <form class="form-horizontal" method="POST" action="{{ route('admin-contact.store') }}" id="contact_form">
                           {{ csrf_field() }}                

                          <div class="form-group{{ $errors->has('office') ? ' has-error' : '' }}">
                               <label for="office" class="col-md-4 control-label"><p>Office</p></label>

                                  <div class="col-md-6">
                                   <input id="office" type="text" class="form-control" name="office" value="{{ old('office') }}" placeholder="Ex: Farzan">
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
                                     <textarea id="address" type="text" class="form-control textarea" name="address" value="{{ old('address') }}" placeholder="Ex: Farzan"></textarea>

                                      @if ($errors->has('address'))
                                       <span class="help-block">
                                          <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                       @endif
                                    </div>
                              </div>

                        <div class="form-group{{ $errors->has('cell') ? ' has-error' : '' }}">
                            <label for="cell" class="col-md-4 control-label"><p>Cell no</p></label>
                            <div class="col-md-6">
                                 <input id="cell" type="text" class="form-control" name="cell" value="{{ old('cell') }}" placeholder="Ex: +88019XXXXXXXX">

                                @if ($errors->has('cell'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cell') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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
                                <button type="submit" class="glyphicon glyphicon-hdd btn submit-ghost">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                      </div> 
                    </div>

                    <!-- List -->
                    
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-dashboard fa-fw"></i> Dashboard</div>
                      <div class="panel-body">
                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover">
                           <thead>
                            <tr>
                             <th>Name</th>
                             <th>Address</th>
                             <th>View</th>
                             <th>Delete</th>
                             <th>Edit</th>
                            </tr>
                           </thead>
                           <tbody>
                             @forelse($ContactUs as $cu)
                             <tr>
                               <td><b><p>{{ $cu->office }}</p></b></td>
                               <td>{{ $cu->address }}</td>
                               <td><a href="{{route('admin-contact.show',['id'=>$cu->id])}}" class="glyphicon glyphicon-eye-open view-ghost"></a></td>
                               <td><button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                <!-- conform delete modal -->
                                {!! Form::open(array('route' => ['admin-contact.destroy',$cu->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                  @include('message.delete_conformation')
                                {!! Form::close() !!}
                               </td>
                               <td>
                                   <a href="{{route('admin-contact.edit',['id'=>$cu->id])}}" class="glyphicon glyphicon-pencil edit-ghost" style=" text-decoration:none;"></a>
                               </td>
                             </tr>
                             @empty
                              <tr>
                                <td colspan="5"><center><p style="color: #6F7823;">No destinatione details found</p></center></td>
                              </tr>
                             @endforelse 
                           </tbody>

                         </table>
                          {!! $ContactUs->appends(Request::all())->render() !!}
                       </div>
                        </div>
                    </div>


                </div>
                <!-- Left side -->
                @include('admin.feedback.feedback_index')
               
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
    $("#contact_form").validate({
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
