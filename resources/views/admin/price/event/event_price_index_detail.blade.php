@extends('layouts.app_admin')

@section('title')
VRS Event Rent
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
                      <div class="panel-heading"><i class="fa fa-table fa-fw"></i> VRS Event Rent details</div>
                      <div class="panel-body">
                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover">
                           <thead>
                             <tr>
                                <th>Event</th>
                                <th>Event type</th>
                                <th>Vehicle type</th>
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td>{{ $EventPriceDetail->event_detail->name }}</td>
                               <td>{{ $EventPriceDetail->event_detail->event_type->name }}</td>
                               <td>{{ $EventPriceDetail->vehicle_type->name }}</td>
                             </tr>
                           </tbody>
                         </table>
                       </div>

                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover">
                           <thead>
                             <tr>
                                <th>Event ticket price</th>
                                <th>Vehicle price</th>
                                <th>Total price</th>
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td>{{ $EventPriceDetail->ticket_price }}</td>
                               <td>{{ $EventPriceDetail->vehicle_price }}</td>
                               <td>{{ $EventPriceDetail->total_price }}</td>
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
                               <td>{{ $EventPriceDetail->admin->name }}</td>
                               <td>{{ $EventPriceDetail->created_at}}<br/>({{ $EventPriceDetail->created_at->diffForHumans() }})</td>
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
                                {!! Form::open(array('route' => ['admin-event_price.destroy',$EventPriceDetail->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                        @include('message.delete_conformation')
                                {!! Form::close() !!}</td>
                               <td><a href="{{ route('admin-event_price.edit', ['id'=>$EventPriceDetail->id]) }}" class="glyphicon glyphicon-pencil edit-ghost" style=" text-decoration:none;"></td>
                               
                             </tr>
                           </tbody>
                            <tfoot>
                             <tr>
                               <td colspan="2"><center><a href="{{ route('admin-event_price.index') }}" class="glyphicon glyphicon-menu-left go-back-ghost" style=" text-decoration:none;"></a></center></td>
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
