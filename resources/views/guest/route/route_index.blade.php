@extends('layouts.app')

@section('title')
Route list
@endsection

@section('content')
<div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-default">
            <div class="panel-body">
             <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
               @forelse($Route as $route)
                 <div class="panel panel-default">
                   <div class="panel-heading" role="tab" id="heading-div-one-{{$route->id}}">
                       <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$route->id}}" aria-expanded="false" aria-controls="collapse-{{$route->id}}">
                        {{$route->origin}}- {{ $route->destination }}
                        </a>
                       </h4>
                    </div>
                    <div class="collapse" id="collapse-{{$route->id}}" role="tabpanel" aria-labelledby="heading-div-one-{{$route->id}}">
                          <div class="panel-body">
                              <div class="table-responsive">
                                 <table class="table table-striped table-bordered table-hover">
                                      <tbody>
                                            <tr>
                                                <td>Distance</td>
                                                <td>:</td>
                                                <td>{{ $route->distance }} km.</td>
                                            </tr>
                                            <tr>
                                                <td>Time(depend on traffic)</td>
                                                <td>:</td>
                                                <td>{{ $route->time }} hr.</td>
                                            </tr>
                                        </tbody>
                                   </table> 
                              </div>
                          </div>
                          <div class="panel-body">
                             <a role="button" data-toggle="collapse" href="#collapse-rent-price-list-{{$route->id}}" aria-expanded="false" aria-controls="collapse-rent-price-list-{{$route->id}}" class="btn btn-primary">Price list </a>
                          </div>
                          <div class="panel-body collapse" id="collapse-rent-price-list-{{$route->id}}">
                            <div class="panel-group" id="accordion-{{$route->id}}-price-list" role="tablist" aria-multiselectable="false">
                                @foreach($VehicleRentPrice as $vrp)
                                  @if($route->id==$vrp->route_id)
                                      <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="heading-{{$vrp->vehicle_type_id}}-{{$vrp->route_id}}">
                                          <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion-{{$route->id}}-price-list" href="#collapse-rent-{{$vrp->vehicle_type_id}}-{{$vrp->route_id}}" aria-expanded="false" aria-controls="collapse-rent-{{$vrp->vehicle_type_id}}-{{$vrp->route_id}}">
                                                  {{$vrp->vehicle_type->name}}
                                            </a>
                                          </h4>
                                        </div>
                                        <div id="collapse-rent-{{$vrp->vehicle_type_id}}-{{$vrp->route_id}}" class="collapse panel-collapse" role="tabpanel" aria-labelledby="heading-{{$vrp->vehicle_type_id}}-{{$vrp->route_id}}">
                                          <div class="panel-body">
                                            <div class="table-responsive">
                                              <table class="table table-striped table-bordered table-hover">
                                                  <tbody>
                                                      <tr>
                                                         <td colspan="3"><center>Rent price for <b>{{$vrp->vehicle_type->name}}</b></center>
                                                         </td>
                                                      </tr>
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
                                                           <td>Total price</td>
                                                           <td>:</td>
                                                           <td>{{$vrp->total_price}}</td>
                                                        </tr>
                                                        <tr>
                                                           <td>Toll</td>
                                                           <td>:</td>
                                                           <td>Paid by client</td>
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
                    </div>
                </div>
               @empty
                <div class="panel panel-default">
                      <div class="panel-body">
                          <h4 class="panel-heading">No route available</h4>
                      </div>
                  </div>
               @endforelse 
               <center>{!! $Route->appends(Request::all())->render() !!}</center> 
             </div>
           </div>
          </div>
        </div>
</div>


</script>
@endsection