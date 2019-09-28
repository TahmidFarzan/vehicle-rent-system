@extends('layouts.app_admin')

@section('title')
Contact Detail
@endsection

@section('content')
    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Contact</h1>
                    <!-- Messages -->
                    
                </div>
                
            </div>
            
            <div class="row">
               <!-- Right side -->
                <div class="col-lg-9">
                     
                    <!-- View -->
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-table fa-fw"></i> Contact details</div>
                      <div class="panel-body">
                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover">
                           <thead>
                            <tr>
                              <th>Office name</th>
                              <th>Address</th>
                            </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td>{{ $ContactUs->office }}</td>
                               <td>{{ $ContactUs->address }}</td>
                             </tr>
                             
                           </tbody>
                         </table>
                       </div>
                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover">
                           <thead>
                            <tr>
                              <th>Cell no</th>
                              <th>Email</th>
                              <th>Add by</th>
                              <th>Add date</th>
                            </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td>{{ $ContactUs->cell }}</td>
                               <td>{{ $ContactUs->email }}</td>
                               <td>{{ $ContactUs->admin->name }}</td>
                               <td>{{ $ContactUs->created_at}}<br/>({{ $ContactUs->created_at->diffForHumans() }})</td>
                             </tr>
                             
                           </tbody>
                         </table>
                       </div>
                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover">
                           <thead>
                             <tr>
                               <th>Delete</th>
                               <th>Edit</th>
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td><button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                <!-- conform delete modal -->
                                {!! Form::open(array('route' => ['admin-contact.destroy',$ContactUs->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                        @include('message.delete_conformation')
                                {!! Form::close() !!}</td>
                               <td><a href="{{ route('admin-contact.edit', ['id'=>$ContactUs->id]) }}" class="glyphicon glyphicon-pencil edit-ghost" style=" text-decoration:none;"></td>
                               
                             </tr>
                           </tbody>
                            <tfoot>
                             <tr>
                               <td colspan="2"><center><a href="{{ route('admin-contact.index') }}" class="glyphicon glyphicon-menu-left go-back-ghost" style=" text-decoration:none;"></a></center></td>
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
