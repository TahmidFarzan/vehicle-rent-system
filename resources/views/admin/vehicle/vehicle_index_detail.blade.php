@extends('layouts.app_admin')

@section('title')
VRS Vehicle
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
                      <div class="panel-heading"><i class="fa fa-table fa-fw"></i> Vehicle View</div>
                      <div class="panel-body">
                        <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th><center><img src="{{ asset('image/vehicle/'.$VehicleDetail->image_name) }}" alt="No image." class="img-responsive" width="300px" height="275px"></center></th>
                            </tr>
                          </thead>
                         </table>
                       </div>
                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>Vehicle Name</th>
                              <th>Vehicle type</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>{{ $VehicleDetail->name }}</td>
                              <td>{{ $VehicleDetail->vehicle_type->name }}</td>
                            </tr>
                          </tbody>

                         </table>
                       </div>

                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>Vehicle Seat amount</th>
                              <th>Vehicle Licence no</th>
                              <th>Add by</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>{{ $VehicleDetail->seat }}</td>
                              <td>{{ $VehicleDetail->licence_no }}</td>
                              <td>{{ $VehicleDetail->admin->name }}</td>
                            </tr>
                          </tbody>
                         </table>
                       </div>

                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>Add date</th>
                              <th>Edit</th>
                              <th>Delete</th>
                            </tr>
                           </thead>
                           <tbody>
                            <tr>
                              <td>{{ $VehicleDetail->created_at}}<br/>({{ $VehicleDetail->created_at->diffForHumans() }})</td>
                              <td><a href="{{ route('admin-vehicle.edit', ['id'=>$VehicleDetail->id]) }}" class="glyphicon glyphicon-pencil edit-ghost" style=" text-decoration:none; float: left;"></a></td>
                              <td><button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                <!-- conform delete modal -->
                                 {!! Form::open(array('route' => ['admin-vehicle.destroy',$VehicleDetail->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                       @include('message.delete_conformation')
                                 {!! Form::close() !!}</td>
                            </tr>
                           </tbody>
                           <tfoot>
                            <tr>
                              <td colspan="3"><center><a href="{{ route('admin-vehicle.index') }}" class="glyphicon glyphicon-menu-left go-back-ghost" style=" text-decoration:none;"></a></center></td>
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
