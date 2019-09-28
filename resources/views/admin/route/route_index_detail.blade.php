@extends('layouts.app_admin')

@section('title')
Route Detail
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
                      <div class="panel-heading"><i class="fa fa-table fa-fw"></i> Route Detail</div>
                      <div class="panel-body">
                        
                           <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                     <thead>
                                         <tr>
                                            <th colspan="3"><center>Route From</center></th>
                                         </tr>
                                         <tr>
                                           <th>Origin</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                           <tr>
                                               <td>{{ $Route->origin }}</td>
                                           </tr>
                                     </tbody>
                                </table> 
                            </div>
                      
                          <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover">
                                   <thead>
                                        <tr>
                                         <th colspan="3"><center>Route To</center></th>
                                        </tr>
                                        <tr>
                                          <th>Destination</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <tr>
                                         <td>{{ $Route->destination }}</td>
                                        </tr>
                                   </tbody>
                               </table> 
                          </div>
                      
                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover">
                          <thead>
                           <tr>
                              <th>Distance</th>
                              <th>Time(depend on traffic)</th>
                            </tr>
                          </thead>
                           <tbody>
                             <tr>
                               <td>{{ $Route->distance }} km.</td>
                              <td>{{ $Route->time }}.</td>
                            </tr>
                           </tbody>
                         </table> 
                       </div>
                        <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover">
                          <thead>
                           <tr>
                              <th>Add by</th>
                              <th>Add time</th>
                            </tr>
                          </thead>
                           <tbody>
                             <tr>
                               <td>{{ $Route->admin->name }}</td>
                              <td>{{ $Route->created_at}}<br/>({{ $Route->created_at->diffForHumans() }})</td>
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
                               <td>
                                <button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                <!-- conform delete modal -->
                                {!! Form::open(array('route' => ['admin-route.destroy',$Route->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                        @include('message.delete_conformation')
                                {!! Form::close() !!}
                               </td>
                              <td>
                                <a href="{{ route('admin-route.edit', ['id'=>$Route->id]) }}" class="glyphicon glyphicon-pencil edit-ghost" style=" text-decoration:none; float: left;"></a>
                              </td>
                            </tr>
                           </tbody>
                         </table> 
                       </div>
                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover">
                          <tfoot>
                             <tr>
                               <td colspan="3"><center><a href="{{ route('admin-route.index') }}" class="glyphicon glyphicon-menu-left go-back-ghost" style=" text-decoration:none;"></a></center></td>
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
