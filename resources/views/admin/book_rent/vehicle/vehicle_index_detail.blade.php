@extends('layouts.app_admin')

@section('title')
VSR Vehicle detail
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
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> Rent book details</div>
                      <div class="panel-body">
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>User name</th>
                                  <th>User email</th>
                                  <th>User Mobile</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th>{{$VehicleBookRent->name}}</th>
                                  <th>{{$VehicleBookRent->email}}</th>
                                  <th>{{$VehicleBookRent->mobile}}</th>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>Journey date</th>
                                  <th>Return date</th>
                                  <th>Take off address</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th><input type="date" name="journey_date" value="{{$VehicleBookRent->journey_date}}" class="form-control" readonly></th>
                                  <th><input type="date" name="return_date" value="{{$VehicleBookRent->return_date}}" class="form-control" readonly></th>
                                  <th>{{$VehicleBookRent->take_off_address}}</th>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>Vehicle amount</th>
                                  <th>Price</th>
                                  <th>Vehicle type</th>
                                  <th>Route</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th>{{$VehicleBookRent->vehicle_amount}}</th>
                                  <th>{{$VehicleBookRent->price}}</th>
                                  <th>{{$VehicleBookRent->vehicle_type->name}}</th>
                                  <th>{{$VehicleBookRent->route->origin}} - {{$VehicleBookRent->route->destination}}</th>
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
                                  <th>{{ $VehicleBookRent->admin->name }}</th>
                                  <th>{{ $VehicleBookRent->created_at}}<br/>({{ $VehicleBookRent->created_at->diffForHumans() }})</th>
                                <th><button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                  <!-- conform delete modal -->
                                  {!! Form::open(array('route' => ['admin-vehicle_book_rent.destroy',$VehicleBookRent->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                       @include('message.delete_conformation')
                                  {!! Form::close() !!}</th>
                                  <th> 
                                    <button type="button" class="glyphicon glyphicon-envelope replay-mail-ghost" data-toggle="modal" data-target="#Mail"> Mail</button>
                                    {!! Form::open(array('route' => ['admin-vehicle_book_rent.store'],'method'=>'POST','class'=>'form-horizontal','id'=>'mail_form')) !!}
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
                                                        <div class="form-group{{ $errors->has('journey_date') ? ' has-error' : '' }}">
                                                           <label for="journey_date" class="col-md-4 control-label"><p>Journey date</p></label>
                                                           <div class="col-md-6">
                                                               <input id="journey_date" type="date" class="form-control" name="journey_date" value="{{ $VehicleBookRent->journey_date }}" placeholder="" readonly>
                                                                 @if ($errors->has('journey_date'))
                                                                    <span class="help-block">
                                                                       <strong>{{ $errors->first('journey_date') }}</strong>
                                                                   </span>
                                                                @endif
                                                            </div>
                                                       </div>
                                                       <div class="form-group{{ $errors->has('return_date') ? ' has-error' : '' }}">
                                                            <label for="return_date" class="col-md-4 control-label"><p>Return date</p></label>
                                                            <div class="col-md-6">
                                                                 <input id="return_date" type="date" class="form-control" name="return_date" value="{{ $VehicleBookRent->return_date }}" placeholder="" readonly>
                                                                 @if ($errors->has('return_date'))
                                                                     <span class="help-block">
                                                                          <strong>{{ $errors->first('return_date') }}</strong>
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
                                                              <input id="email" type="hidden" class="form-control" name="email" value="{{$VehicleBookRent->email }}" placeholder="Ex: farzan@email.com" readonly>
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
            journey_date:{
              required:true,
              date:true
            },
            return_date:{
              required:true,
              date:true
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
