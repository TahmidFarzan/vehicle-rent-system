@extends('layouts.app_admin')

@section('title')
VSR Rent mail
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
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> Rent mail</div>
                      <div class="panel-body">

                        <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>From</th>
                              <th>To</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>{{ $RentMail->from }}</td>
                              <td>{{ $RentMail->to }}</td>
                            </tr>
                          </tbody>

                         </table>
                       </div>


                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>Subject</th>
                              <th>Message</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>{{ $RentMail->subject }}</td>
                              <td>{{ $RentMail->message }}</td>
                            </tr>
                          </tbody>
                         </table>
                       </div>

                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>Add date</th>
                              <th>Add by</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>{{ $RentMail->created_at}}<br/>({{ $RentMail->created_at->diffForHumans() }})</td>
                              <td>{{ $RentMail->admin->name }}</td>
                            </tr>
                          </tbody>

                         </table>
                       </div>
                       
                        <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>Delete</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                <!-- conform delete modal -->
                                 {!! Form::open(array('route' => ['admin-rent_mail.destroy',$RentMail->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                       @include('message.delete_conformation')
                                 {!! Form::close() !!}</td>
                            </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="3"><center><a href="{{ route('admin-rent_mail.index') }}" class="glyphicon glyphicon-menu-left go-back-ghost" style=" text-decoration:none;"></a></center></td>
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

@endsection
