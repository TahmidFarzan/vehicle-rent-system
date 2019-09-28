@extends('layouts.app')

@section('title')
Vehicle list-{{ $VehicleDetail->name }}
@endsection

@section('content')
<div class="row">
        <div class="col-md-10 col-md-offset-1">
             <div class="panel panel-default">
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
                            </tr>
                           </thead>
                           <tbody>
                            <tr>
                              <td>{{ $VehicleDetail->created_at}}<br/>({{ $VehicleDetail->created_at->diffForHumans() }})</td>
                            </tr>
                           </tbody>
                         </table>
                       </div>
                      </div>
                      <div class="panel-body">
                         <a role="button" data-toggle="collapse" href="#collapse-rent-price" aria-expanded="false" aria-controls="collapse-rent-price" class="btn btn-primary">Price list</a>
                      </div>
                      <div class="panel-body collapse" id="collapse-rent-price">
                          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                              @foreach($VehicleRentPrice as $vrp)
                                @if($VehicleDetail->type_id==$vrp->vehicle_type_id)
                                  <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-{{$vrp->route->id}}-{{$vrp->vehicle_type_id}}">
                                      <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$vrp->route->id}}-{{$vrp->vehicle_type_id}}" aria-expanded="false" aria-controls="collapse-{{$vrp->route->id}}-{{$vrp->vehicle_type_id}}">
                                        ({{$vrp->route->origin}})-({{$vrp->route->destination}})
                                        </a>
                                      </h4>
                                    </div>
                                    <div id="collapse-{{$vrp->route->id}}-{{$vrp->vehicle_type_id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-{{$vrp->route->id}}-{{$vrp->vehicle_type_id}}">
                                      <div class="panel-body">
                                        <div class="table-responsive">
                                              <table class="table table-striped table-bordered table-hover">
                                                  <tbody>
                                                       <tr>
                                                         <td>Distance price</td>
                                                         <td>:</td>
                                                         <td>{{$vrp->distance_price}}</td>
                                                       </tr>
                                                       <tr>
                                                          <td>Rent price</td>
                                                          <td>:</td>
                                                          <td>{{$vrp->rent_price}}</td>
                                                       </tr>
                                                        <tr>
                                                           <td>Total price(Only include vehicle price and distance price)</td>
                                                           <td>:</td>
                                                           <td>{{$vrp->total_price}}</td>
                                                        </tr>
                                                        <tr>
                                                           <td>Toll</td>
                                                           <td>:</td>
                                                           <td>Paid by client</td>
                                                        </tr>
                                                        <tr>
                                                           <td>Driver allowance</td>
                                                           <td>:</td>
                                                           <td>Paid by client as per day(500-1000)Taka</td>
                                                        </tr>
                                                  </tbody>
                                              </table> 
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                @endif
                              @endforeach
                          </div>
                      </div>
                      <div class="panel-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover" >
                                    <tfoot>
                                          <tr>
                                              <td colspan="3"><center><a href="{{ route('vehicle-list.index') }}" class="glyphicon glyphicon-menu-left go-back-ghost" style=" text-decoration:none;"></a></center></td>
                                           </tr>
                                    </tfoot>
                              </table>
                          </div>
                     </div>
                    </div>
        </div>
</div>

@endsection