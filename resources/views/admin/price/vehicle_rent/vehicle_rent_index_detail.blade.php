@extends('layouts.app_admin')

@section('title')
VRS Vehicle Rent
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
                      <div class="panel-heading"><i class="fa fa-table fa-fw"></i> VRS Vehicle rent details</div>
                      <div class="panel-body">
                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover">
                           <thead>
                            <tr>
                              <th>Route</th>
                              <th>Vehicle type</th>
                              <th>Distance price</th>
                            </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td>({{$VehicleRentPrice->route->origin}})- ({{$VehicleRentPrice->route->destination}})</td>
                               <td>{{ $VehicleRentPrice->vehicle_type->name }}</td>
                               <td>{{ $VehicleRentPrice->distance_price }}</td>
                             </tr>
                           </tbody>
                         </table>
                       </div>

                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover">
                           <thead>
                            <tr>
                              <th>Rent price</th>
                              <th>Total price</th>
                            </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td>{{ $VehicleRentPrice->rent_price }}</td>
                               <td>{{ $VehicleRentPrice->total_price }}</td>
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
                            </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td>{{ $VehicleRentPrice->admin->name }}</td>
                               <td>{{ $VehicleRentPrice->created_at}}<br/>({{ $VehicleRentPrice->created_at->diffForHumans() }})</td>
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
                                {!! Form::open(array('route' => ['admin-vehicle_rent_price.destroy',$VehicleRentPrice->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                        @include('message.delete_conformation')
                                {!! Form::close() !!}</td>
                               <td><a href="{{ route('admin-vehicle_rent_price.edit', ['id'=>$VehicleRentPrice->id]) }}" class="glyphicon glyphicon-pencil edit-ghost" style=" text-decoration:none;"></td>
                               
                             </tr>
                           </tbody>
                            <tfoot>
                             <tr>
                               <td colspan="2"><center><a href="{{ route('admin-vehicle_rent_price.index') }}" class="glyphicon glyphicon-menu-left go-back-ghost" style=" text-decoration:none;"></a></center></td>
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
