@extends('layouts.app_admin')

@section('title')
VRS Feedback
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
                     
                    <!-- View -->
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-table fa-fw"></i> Feedback details</div>
                      <div class="panel-body">
                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover">
                           <thead>
                            <tr>
                              <th>Sender name</th>
                              <th>Sender email</th>
                              <th>Send date</th>
                            </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td>{{ $Feedbacks->name }}</td>
                               <td>{{ $Feedbacks->email }}</td>
                               <td>{{ $Feedbacks->created_at}}<br/>({{ $Feedbacks->created_at->diffForHumans() }})</td>
                             </tr>
                             
                           </tbody>
                         </table>
                       </div>
                        <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover">
                           <thead>
                            <tr>
                              <th><center>Membership</center></th>
                            </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td>
                                  <center>
                                     @foreach($User as $user)
                                        @if($user->email==$Feedbacks->email)
                                           Register user
                                        @endif

                                        @if($user->email!=$Feedbacks->email)
                                           Guest user
                                        @endif
                                     @endforeach
                                  </center>
                               </td>
                             </tr>
                           </tbody>
                         </table>
                       </div>
                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover">
                           <thead>
                            <tr>
                              <th>Sender Message</th>
                            </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td>{{ $Feedbacks->message }}</td>
                             </tr>
                             
                           </tbody>
                         </table>
                       </div>
                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover">
                           <thead>
                             <tr>
                               <th>Delete</th>
                               <th>Replay mail</th>
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td><button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                <!-- conform delete modal -->
                                {!! Form::open(array('route' => ['admin-feedback.destroy',$Feedbacks->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                        @include('message.delete_conformation')
                                {!! Form::close() !!}</td>
                               <td>
                                   <button type="button" class="glyphicon glyphicon-envelope replay-mail-ghost" data-toggle="modal" data-target="#ReplayMail"> Replay</button>
                                     {!! Form::open(array('route' => ['admin.reply.mail'],'method'=>'POST','class'=>'form-horizontal','id'=>'sent_reply_mail_form')) !!}
                                         {{ csrf_field() }}

                                         <div class="modal fade" tabindex="-1" role="dialog" id="ReplayMail">
                                           <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                   <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                   </div>
                                                   <div class="modal-body">

                                                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                                                           <label for="subject" class="col-md-4 control-label">Subject</label>
                                                          <div class="col-md-6">
                                                              <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject') }}" placeholder="Ex: Hello">
                                                              @if ($errors->has('subject'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('subject') }}</strong>
                                                                </span>
                                                              @endif
                                                          </div>
                                                        </div>

                                                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                                           <label for="subject" class="col-md-4 control-label">Message</label>

                                                          <div class="col-md-6">
                                                              <textarea id="message" type="text" class="form-control textarea" name="message" placeholder="Ex: Hello">{{ old('message') }}</textarea>
                                                              @if ($errors->has('message'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('message') }}</strong>
                                                                </span>
                                                              @endif
                                                          </div>
                                                        </div>
                                                       <div class="form-group{{ $errors->has('admin') ? ' has-error' : '' }}">
                                                           <label for="admin" class="col-md-4 control-label"></label>
                                                          <div class="col-md-6">
                                                              <input id="admin" type="hidden" class="form-control" name="admin" value="{{Auth::user()->email }}" placeholder="Ex: farzan@email.com" readonly>
                                                              @if ($errors->has('admin'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('admin') }}</strong>
                                                                </span>
                                                              @endif
                                                          </div>
                                                        </div>
                                                       <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                           <label for="email" class="col-md-4 control-label"></label>
                                                          <div class="col-md-6">
                                                              <input id="email" type="hidden" class="form-control" name="email" value="{{$Feedbacks->email }}" placeholder="Ex: farzan@email.com" readonly>
                                                              @if ($errors->has('email'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                </span>
                                                              @endif
                                                          </div>
                                                        </div>

                                                        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                                                           <label for="id" class="col-md-4 control-label"></label>
                                                          <div class="col-md-6">
                                                              <input id="id" type="hidden" class="form-control" name="id" value="{{$Feedbacks->id }}" placeholder="Ex: 1" readonly min="0">
                                                              @if ($errors->has('id'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('id') }}</strong>
                                                                </span>
                                                              @endif
                                                          </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-md-6 col-md-offset-4">
                                                                <button type="submit" class="glyphicon glyphicon-send btn submit-ghost"> Send
                                                                </button>
                                                            </div>
                                                        </div>
                                                   </div>
                                                   <div class="modal-footer">
                                                       <button type="button" class="btn btn-danger" data-dismiss="modal"> Cencel</button>
                                                  </div>
                                               </div>
                                           </div>
                                        </div>
                                    {!! Form::close() !!}
                               </td>
                               
                             </tr>
                           </tbody>
                            <tfoot>
                             <tr>
                               <td colspan="2"><center><a href="{{ route('admin-feedback.index') }}" class="glyphicon glyphicon-menu-left go-back-ghost" style=" text-decoration:none;"></a></center></td>
                             </tr>
                           </tfoot>
                          </table>
                       </div>
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
        $('#sent_reply_mail_form').validate({
          rules:{
            subject:{
              required:true
            },
            message:{
              required:true
            },
           admin:{
              required:true,
              email: true
             },
           email:{
              required:true,
              email: true
            },
             id:{
              required:true,
              number:true
             }
          }
        });

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
