@extends('layouts.app_admin')

@section('title')
VSR Event detail
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
                  <!-- Show -->
                   <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i>Event Rent book details</div>
                      <div class="panel-body">
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>User name</th>
                                  <th>User email</th>
                                  <th>User Mobile</th>
                                  <th>Membership</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th>{{$EventBookRent->name}}</th>
                                  <th>{{$EventBookRent->email}}</th>
                                  <th>{{$EventBookRent->mobile}}</th>
                                   @foreach($User as $user)
                                   <th>
                                        @if($user->email==$EventBookRent->email)
                                           Regester 
                                        @endif
                                        @if($user->email!=$EventBookRent->email)
                                          Guest
                                        @endif
                                   </th>
                                   @endforeach
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>Event</th>
                                  <th>Describtion</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th>{{$EventBookRent->event_detail->name}}</th>
                                  <th>{{$EventBookRent->description}}</th>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>Ticket amount</th>
                                  <th>Vehicle amount</th>
                                  <th>Price</th>
                                  <th>Vehicle type</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th>{{$EventBookRent->ticket_amount}}</th>
                                  <th>{{$EventBookRent->vehicle_amount}}</th>
                                  <th>{{$EventBookRent->price}}</th>
                                  <th>{{$EventBookRent->vehicle_type->name}}</th>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>Add by</th>
                                  <th>Add at</th>
                                  <th>Delete</th>
                                  <th>Mail</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th>{{ $EventBookRent->admin->name }}</th>
                                  <th>{{ $EventBookRent->created_at}}<br/>({{ $EventBookRent->created_at->diffForHumans() }})</th>
                                <th><button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                  <!-- conform delete modal -->
                                  {!! Form::open(array('route' => ['admin-event_book_rent.destroy',$EventBookRent->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                       @include('message.delete_conformation')
                                  {!! Form::close() !!}</th>
                                  <th> 
                                    <button type="button" class="glyphicon glyphicon-envelope replay-mail-ghost" data-toggle="modal" data-target="#Mail"> Mail</button>
                                    {!! Form::open(array('route' => ['admin-event_book_rent.store'],'method'=>'POST','class'=>'form-horizontal','id'=>'mail_form')) !!}
                                         {{ csrf_field() }}

                                         <div class="modal fade" tabindex="-1" role="dialog" id="Mail">
                                           <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                   <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                   </div>
                                                   <div class="modal-body">

                                                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                                                           <label for="subject" class="col-md-4 control-label"><p>Subject</p></label>
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
                                                           <label for="subject" class="col-md-4 control-label"><p>Message</p></label>

                                                          <div class="col-md-6">
                                                              <textarea id="message" type="text" class="form-control textarea" name="message" placeholder="Ex: Hello">{{ old('message') }}</textarea>
                                                              @if ($errors->has('message'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('message') }}</strong>
                                                                </span>
                                                              @endif
                                                          </div>
                                                        </div>
                                                       <div class="form-group{{ $errors->has('event') ? ' has-error' : '' }}">
                                                            <label for="event" class="col-md-4 control-label"><p>Event</p></label>
                                                            <div class="col-md-6">
                                                                 <input id="event" type="text" class="form-control" name="event" value="{{$EventBookRent->event_detail->name}}" placeholder="" readonly>
                                                                 @if ($errors->has('event'))
                                                                     <span class="help-block">
                                                                          <strong>{{ $errors->first('event') }}</strong>
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
                                                              <input id="email" type="hidden" class="form-control" name="email" value="{{$EventBookRent->email }}" placeholder="Ex: farzan@email.com" readonly>
                                                              @if ($errors->has('email'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('email') }}</strong>
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
                                  </th>
                                </tr>
                              </tbody>
                            </table>
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
    $("#mail_form").validate({
     rules:{
            subject:{
              required:true
            },
            message:{
              required:true
            },
            event:{
              required:true,
            },
           admin:{
              required:true,
              email: true,
              maxlength:50
             },
           email:{
              required:true,
              email: true,
              maxlength:50
            }
          }
  });

  
  
   </script>
@endsection
