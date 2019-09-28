@extends('layouts.app_admin')

@section('title')
VSR Dashboard
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
                  <!-- Guest member -->
                   @if($RegUserCount==0)
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> Guest member vehicle book rent request dasboard detail</div>
                        <div class="panel-body">
                           <form class="form-horizontal" method="POST" id="Vehicle_rent_form" action="{{ route('admin.store') }}">
                               {{ csrf_field() }}
                               <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                   <label for="name" class="col-md-4 control-label"><p>Name</p></label>
                                   <div class="col-md-6">
                                       <input id="name" type="text" class="form-control" name="name" value="{{ $VehicleBookRentRequest->name }}" placeholder="Ex: Farzan" readonly>
                                       @if ($errors->has('name'))
                                          <span class="help-block">
                                             <strong>{{ $errors->first('name') }}</strong>
                                          </span>
                                       @endif
                                   </div>
                               </div>

                                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                  <label for="mobile" class="col-md-4 control-label"><p>Mobile</p></label>
                                  <div class="col-md-6">
                                      <input id="mobile" type="text" class="form-control" name="mobile" value="{{ $VehicleBookRentRequest->mobile }}" placeholder="Ex: +88XXXXXXXXXX" readonly>
                                      @if ($errors->has('mobile'))
                                        <span class="help-block">
                                          <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                      @endif
                                 </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                   <label for="email" class="col-md-4 control-label"><p>Email</p></label>
                                   <div class="col-md-6">
                                       <input id="email" type="email" class="form-control" name="email" value="{{ $VehicleBookRentRequest->email }}" placeholder="Ex: xx@xx.com" readonly>
                                       @if ($errors->has('email'))
                                         <span class="help-block">
                                           <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                       @endif
                                   </div>
                               </div>

                               
                                   <div class="form-group">
                                      <label for="email" class="col-md-4 control-label"><p>Membership</p></label>
                                      <div class="col-md-6">
                                            <b>Guest</b>                              
                                      </div>
                                   </div>


                                <div class="form-group{{ $errors->has('journey_date') ? ' has-error' : '' }}">
                                   <label for="journey_date" class="col-md-4 control-label"><p>Journey date</p></label>
                                   <div class="col-md-6">
                                      <input id="journey_date" type="date" class="form-control" name="journey_date" value="{{ $VehicleBookRentRequest->journey_date }}" placeholder="" readonly>
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
                                          <input id="return_date" type="date" class="form-control" name="return_date" value="{{ $VehicleBookRentRequest->return_date }}" placeholder="" readonly>
                                          @if ($errors->has('return_date'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('return_date') }}</strong>
                                          </span>
                                       @endif
                                      </div>
                                </div>

                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                      <label for="description" class="col-md-4 control-label"><p>Description</p></label>
                                     <div class="col-md-6">
                                          <textarea id="description" class="form-control textarea" name="description" placeholder="Ex: Hello" readonly>{{ $VehicleBookRentRequest->description }}</textarea>
                                          @if ($errors->has('description'))
                                            <span class="help-block">
                                             <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                          @endif
                                     </div>
                                </div>

                                <div class="form-group{{ $errors->has('route') ? ' has-error' : '' }}">
                                    <label for="event" class="col-md-4 control-label"><p>Route</p></label>
                                    <div class="col-md-6">
                                         <select class="form-control" id="route" name="route" readonly>
                                            <option value="{{$VehicleBookRentRequest->route_id}}" selected>({{$VehicleBookRentRequest->route->origin}}) - ({{$VehicleBookRentRequest->route->destination}})</option>
                                          </select>

                                          @if ($errors->has('route'))
                                              <span class="help-block">
                                                <strong>{{ $errors->first('route') }}</strong>
                                              </span>
                                          @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('vehicle_type') ? ' has-error' : '' }}">
                                         <label for="vehicle_type" class="col-md-4 control-label"><p>Vehicle Type</p></label>
                                         <div class="col-md-6">
                                             <select class="form-control" id="vehicle_type" name="vehicle_type" readonly>
                                                 <option value="{{$VehicleBookRentRequest->vehicle_type_id}}" selected>{{$VehicleBookRentRequest->vehicle_type->name}}</option>
                                              </select>
                                              @if ($errors->has('vehicle_type'))
                                                  <span class="help-block">
                                                    <strong>{{ $errors->first('vehicle_type') }}</strong>
                                                  </span>
                                               @endif
                                         </div>
                                 </div>

                                <div class="form-group{{ $errors->has('vehicle_amount') ? ' has-error' : '' }}">
                                      <label for="vehicle_amount" class="col-md-4 control-label"><p>Vehicle amount</p></label>
                                      <div class="col-md-6">
                                          <input id="vehicle_amount" type="number" class="form-control" name="vehicle_amount" value="{{ $VehicleBookRentRequest->vehicle_amount }}" placeholder="Ex: 1" min="1" max="{{ $VehicleBookRentRequest->vehicle_amount }}" readonly>
                                          @if ($errors->has('vehicle_amount'))
                                              <span class="help-block">
                                                <strong>{{ $errors->first('vehicle_amount') }}</strong>
                                             </span>
                                          @endif
                                      </div>
                                </div>

                               <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                     <label for="price" class="col-md-4 control-label"><p>Price( <a href="javascript: void(0)" onClick="GuestTotalPriceCalculate()" class="btn submit-ghost">Calculate</a>)</p></label>

                                     <div class="col-md-6">
                                         <input id="price" type="text" class="form-control" name="price" placeholder="Ex:100" readonly>

                                          @if ($errors->has('price'))
                                              <span class="help-block">
                                                 <strong>{{ $errors->first('price') }}</strong>
                                              </span>
                                        @endif
                                     </div>
                                </div>

                                <div class="form-group{{ $errors->has('hidden_price') ? ' has-error' : '' }}">
                                    <label for="hidden_price" class="col-md-4 control-label"></label>

                                    <div class="col-md-6">
                                         @foreach($VehicleRentPrice as $vrp)
                                            @if($vrp->route_id==$VehicleBookRentRequest->route_id)
                                               @if($vrp->vehicle_type_id==$VehicleBookRentRequest->vehicle_type_id)
                                                  <input id="hidden_price" type="hidden" class="form-control" name="hidden_price" value="{{ $vrp->total_price }}" placeholder="Ex:100" readonly>
                                               @endif
                                            @endif
                                         @endforeach
                                          @if ($errors->has('hidden_price'))
                                            <span class="help-block">
                                              <strong>{{ $errors->first('hidden_price') }}</strong>
                                            </span>
                                          @endif
                                     </div>
                                </div>

                                <div class="form-group{{ $errors->has('VehicleBookRentRequest_id') ? ' has-error' : '' }}">
                                       <label for="VehicleBookRentRequest_id" class="col-md-4 control-label"></label>
                                       <div class="col-md-6">
                                            <input id="VehicleBookRentRequest_id" type="hidden" class="form-control" name="VehicleBookRentRequest_id" value="{{ $VehicleBookRentRequest->id }}" placeholder="Ex: 1" min="1" max="{{ $VehicleBookRentRequest->id }}" readonly>
                                            @if ($errors->has('VehicleBookRentRequest_id'))
                                              <span class="help-block">
                                                <strong>{{ $errors->first('VehicleBookRentRequest_id') }}</strong>
                                             </span>
                                           @endif
                                       </div>
                                </div>

                                <div class="form-group{{ $errors->has('route_email') ? ' has-error' : '' }}">
                                       <label for="route_email" class="col-md-4 control-label"></label>

                                       <div class="col-md-6">
                                             <input type="hidden" name="route_email" readonly value="({{$VehicleBookRentRequest->route->origin}}) - ({{$VehicleBookRentRequest->route->destination}})" class="form-control">
                                        </div>
                                </div>

                                <div class="form-group{{ $errors->has('vehicle_type_email') ? ' has-error' : '' }}">
                                   <label for="vehicle_type_email" class="col-md-4 control-label"></label>

                                   <div class="col-md-6">
                                       <input type="hidden" name="vehicle_type_email" readonly value="{{$VehicleBookRentRequest->vehicle_type->name}}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('admin_email') ? ' has-error' : '' }}">
                                    <label for="admin_email" class="col-md-4 control-label"></label>

                                    <div class="col-md-6">
                                        <input type="hidden" name="admin_email" readonly value="{{Auth::user()->email}}" class="form-control">
                                   </div>
                               </div>

                               <div class="form-group">
                                   <div class="col-md-6 col-md-offset-4">
                                       <button type="submit" class="btn submit-ghost">
                                         Accept
                                       </button>
                                   </div>
                               </div>
                           </form>
                         <div class="form-group">
                           <div class="table-responsive">
                             <table class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>Back</th>
                                  <th>Delete</th>
                                </tr>
                              </thead>
                               <tbody>
                                 <tr>
                                   <td><a href="{{ route('admin.index') }}" class="glyphicon glyphicon-menu-left go-back-ghost" style=" text-decoration:none;"></a></td>
                                   <td>
                                      <button type="button" class="btn glyphicon reject-ghost glyphicon-trash" data-toggle="modal" data-target="#Vehicle_rent_reject_modal"> Reject</button>
                                      <!-- conform delete modal -->
                                       <div class="modal fade" tabindex="-1" role="dialog" id="Vehicle_rent_reject_modal">
                                           <div class="modal-dialog" role="document">
                                               <div class="modal-content">
                                                   <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                   </div>
                                                   <div class="modal-body">
                                                        <p style="color: red;">If you Reject it, you can not recover it,So if you Are you Sure then enter yes???</p>
                                                        <form class="form-horizontal" method="POST" id="Vehicle_rent_book_reject_form" action="{{ route('admin.vehicle.book.request.reject') }}">
                                                            {{ csrf_field() }}
                                                            <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
                                                                <label for="user" class="col-md-4 control-label"></label>
                                                                <div class="col-md-6">
                                                                     <input id="user" type="hidden" class="form-control" name="user" value="{{ $VehicleBookRentRequest->email }}" placeholder="Ex: xx@xx.com" readonly>
                                                                       @if ($errors->has('user'))
                                                                         <span class="help-block">
                                                                            <strong>{{ $errors->first('user') }}</strong>
                                                                        </span>
                                                                      @endif
                                                                 </div>
                                                            </div>
                                                            <div class="form-group{{ $errors->has('VehicleBookRentRequest_id_reject') ? ' has-error' : '' }}">
                                                                <label for="VehicleBookRentRequest_id_reject" class="col-md-4 control-label"></label>
                                                                <div class="col-md-6">
                                                                    <input id="VehicleBookRentRequest_id_reject" type="hidden" class="form-control" name="VehicleBookRentRequest_id_reject" value="{{ $VehicleBookRentRequest->id }}" placeholder="Ex: 1" min="1" max="{{ $VehicleBookRentRequest->id }}" readonly>
                                                                    @if ($errors->has('VehicleBookRentRequest_id_reject'))
                                                                     <span class="help-block">
                                                                        <strong>{{ $errors->first('VehicleBookRentRequest_id_reject') }}</strong>
                                                                    </span>
                                                                  @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group{{ $errors->has('admins_email') ? ' has-error' : '' }}">
                                                                <label for="admins_email" class="col-md-4 control-label"></label>
                                                                <div class="col-md-6">
                                                                    <input type="hidden" name="admins_email" readonly value="{{Auth::user()->email}}" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                  <button type="submit" class="btn submit-ghost">Yes</button>
                                                                 <button type="button" class="btn btn-danger" data-dismiss="modal"> No</button>
                                                            </div>  
                                                        </form>
                                                   </div>
                                             </div>
                                         </div>
                                      </div>
                                   </td>
                                 </tr>
                               </tbody>
                             </table>
                           </div>
   
                        </div>                    
                        </div> 
                    </div>
                   @endif
                  <!-- Register member -->
                  @if($RegUserCount>0)
                   <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i>Regester Member vehicle book rent request dasboard detail</div>
                        <div class="panel-body">
                           <form class="form-horizontal" method="POST" id="Vehicle_rent_form" action="{{ route('admin.store') }}">
                               {{ csrf_field() }}
                               <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                   <label for="name" class="col-md-4 control-label"><p>Name</p></label>
                                   <div class="col-md-6">
                                       <input id="name" type="text" class="form-control" name="name" value="{{ $VehicleBookRentRequest->name }}" placeholder="Ex: Farzan" readonly>
                                       @if ($errors->has('name'))
                                          <span class="help-block">
                                             <strong>{{ $errors->first('name') }}</strong>
                                          </span>
                                       @endif
                                   </div>
                               </div>

                                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                  <label for="mobile" class="col-md-4 control-label"><p>Mobile</p></label>
                                  <div class="col-md-6">
                                      <input id="mobile" type="text" class="form-control" name="mobile" value="{{ $VehicleBookRentRequest->mobile }}" placeholder="Ex: +88XXXXXXXXXX" readonly>
                                      @if ($errors->has('mobile'))
                                        <span class="help-block">
                                          <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                      @endif
                                 </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                   <label for="email" class="col-md-4 control-label"><p>Email</p></label>
                                   <div class="col-md-6">
                                       <input id="email" type="email" class="form-control" name="email" value="{{ $VehicleBookRentRequest->email }}" placeholder="Ex: xx@xx.com" readonly>
                                       @if ($errors->has('email'))
                                         <span class="help-block">
                                           <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                       @endif
                                   </div>
                               </div>

                             <div class="form-group">
                                      <label for="email" class="col-md-4 control-label"><p>Membership</p></label>
                                      <div class="col-md-6">
                                            <b>Register</b>                              
                                      </div>
                                   </div>

                                <div class="form-group{{ $errors->has('journey_date') ? ' has-error' : '' }}">
                                   <label for="journey_date" class="col-md-4 control-label"><p>Journey date</p></label>
                                   <div class="col-md-6">
                                      <input id="journey_date" type="date" class="form-control" name="journey_date" value="{{ $VehicleBookRentRequest->journey_date }}" placeholder="" readonly>
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
                                          <input id="return_date" type="date" class="form-control" name="return_date" value="{{ $VehicleBookRentRequest->return_date }}" placeholder="" readonly>
                                          @if ($errors->has('return_date'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('return_date') }}</strong>
                                          </span>
                                       @endif
                                      </div>
                                </div>

                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                      <label for="description" class="col-md-4 control-label"><p>Description</p></label>
                                     <div class="col-md-6">
                                          <textarea id="description" class="form-control textarea" name="description" placeholder="Ex: Hello" readonly>{{ $VehicleBookRentRequest->description }}</textarea>
                                          @if ($errors->has('description'))
                                            <span class="help-block">
                                             <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                          @endif
                                     </div>
                                </div>

                                <div class="form-group{{ $errors->has('route') ? ' has-error' : '' }}">
                                    <label for="event" class="col-md-4 control-label"><p>Route</p></label>
                                    <div class="col-md-6">
                                         <select class="form-control" id="route" name="route" readonly>
                                            <option value="{{$VehicleBookRentRequest->route_id}}" selected>({{$VehicleBookRentRequest->route->origin}}) - ({{$VehicleBookRentRequest->route->destination}})</option>
                                          </select>

                                          @if ($errors->has('route'))
                                              <span class="help-block">
                                                <strong>{{ $errors->first('route') }}</strong>
                                              </span>
                                          @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('vehicle_type') ? ' has-error' : '' }}">
                                         <label for="vehicle_type" class="col-md-4 control-label"><p>Vehicle Type</p></label>
                                         <div class="col-md-6">
                                             <select class="form-control" id="vehicle_type" name="vehicle_type" readonly>
                                                 <option value="{{$VehicleBookRentRequest->vehicle_type_id}}" selected>{{$VehicleBookRentRequest->vehicle_type->name}}</option>
                                              </select>
                                              @if ($errors->has('vehicle_type'))
                                                  <span class="help-block">
                                                    <strong>{{ $errors->first('vehicle_type') }}</strong>
                                                  </span>
                                               @endif
                                         </div>
                                 </div>

                                <div class="form-group{{ $errors->has('vehicle_amount') ? ' has-error' : '' }}">
                                      <label for="vehicle_amount" class="col-md-4 control-label"><p>Vehicle amount</p></label>
                                      <div class="col-md-6">
                                          <input id="vehicle_amount" type="number" class="form-control" name="vehicle_amount" value="{{ $VehicleBookRentRequest->vehicle_amount }}" placeholder="Ex: 1" min="1" max="{{ $VehicleBookRentRequest->vehicle_amount }}" readonly>
                                          @if ($errors->has('vehicle_amount'))
                                              <span class="help-block">
                                                <strong>{{ $errors->first('vehicle_amount') }}</strong>
                                             </span>
                                          @endif
                                      </div>
                                </div>

                               <div class="form-group{{ $errors->has('member_offer_range') ? ' has-error' : '' }}">
                               <label for="member_offer_range" class="col-md-4 control-label"><p>Member Offer Range</p></label>

                                <div class="col-md-6">
                                   <input id="member_offer_range" type="number" class="form-control" name="member_offer_range" value="1000" placeholder="Ex:1000" placeholder="Ex:10" required min="1">

                                   @if ($errors->has('member_offer_range'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('member_offer_range') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                             </div>

                            <div class="form-group{{ $errors->has('member_offer') ? ' has-error' : '' }}">
                               <label for="member_offer" class="col-md-4 control-label"><p>Member Offer(%)</p></label>

                                <div class="col-md-6">
                                   <input id="member_offer" type="number" class="form-control" name="member_offer" value="5" placeholder="Ex:100" placeholder="Ex:10" required max="100" min="1">

                                   @if ($errors->has('member_offer'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('member_offer') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                               <label for="price" class="col-md-4 control-label"><p>Price <a href="javascript: void(0)" onClick="RegTotalPriceCalculate()" class="btn submit-ghost" id="calculate">Cal</a></p>
                                <a href="javascript: void(0)" onClick="RegTotalPriceCalculateWithOffer()" class="btn submit-ghost" id="calculate_with_offer_button">Cal With offer</a>
                               </label>

                                <div class="col-md-6">
                                   <input id="price" type="text" class="form-control" name="price" placeholder="Ex:100" readonly>

                                   @if ($errors->has('price'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('price') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>

                                <div class="form-group{{ $errors->has('hidden_price') ? ' has-error' : '' }}">
                                    <label for="hidden_price" class="col-md-4 control-label"></label>

                                    <div class="col-md-6">
                                         @foreach($VehicleRentPrice as $vrp)
                                            @if($vrp->route_id==$VehicleBookRentRequest->route_id)
                                               @if($vrp->vehicle_type_id==$VehicleBookRentRequest->vehicle_type_id)
                                                  <input id="hidden_price" type="hidden" class="form-control" name="hidden_price" value="{{ $vrp->total_price }}" placeholder="Ex:100" readonly>
                                               @endif
                                            @endif
                                         @endforeach
                                          @if ($errors->has('hidden_price'))
                                            <span class="help-block">
                                              <strong>{{ $errors->first('hidden_price') }}</strong>
                                            </span>
                                          @endif
                                     </div>
                                </div>

                                <div class="form-group{{ $errors->has('VehicleBookRentRequest_id') ? ' has-error' : '' }}">
                                       <label for="VehicleBookRentRequest_id" class="col-md-4 control-label"></label>
                                       <div class="col-md-6">
                                            <input id="VehicleBookRentRequest_id" type="hidden" class="form-control" name="VehicleBookRentRequest_id" value="{{ $VehicleBookRentRequest->id }}" placeholder="Ex: 1" min="1" max="{{ $VehicleBookRentRequest->id }}" readonly>
                                            @if ($errors->has('VehicleBookRentRequest_id'))
                                              <span class="help-block">
                                                <strong>{{ $errors->first('VehicleBookRentRequest_id') }}</strong>
                                             </span>
                                           @endif
                                       </div>
                                </div>

                                <div class="form-group{{ $errors->has('route_email') ? ' has-error' : '' }}">
                                       <label for="route_email" class="col-md-4 control-label"></label>

                                       <div class="col-md-6">
                                             <input type="hidden" name="route_email" readonly value="({{$VehicleBookRentRequest->route->origin}}) - ({{$VehicleBookRentRequest->route->destination}})" class="form-control">
                                        </div>
                                </div>

                                <div class="form-group{{ $errors->has('vehicle_type_email') ? ' has-error' : '' }}">
                                   <label for="vehicle_type_email" class="col-md-4 control-label"></label>

                                   <div class="col-md-6">
                                       <input type="hidden" name="vehicle_type_email" readonly value="{{$VehicleBookRentRequest->vehicle_type->name}}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('admin_email') ? ' has-error' : '' }}">
                                    <label for="admin_email" class="col-md-4 control-label"></label>

                                    <div class="col-md-6">
                                        <input type="hidden" name="admin_email" readonly value="{{Auth::user()->email}}" class="form-control">
                                   </div>
                               </div>

                               <div class="form-group">
                                   <div class="col-md-6 col-md-offset-4">
                                       <button type="submit" class="btn submit-ghost">
                                         Accept
                                       </button>
                                   </div>
                               </div>
                           </form>
                         <div class="form-group">
                           <div class="table-responsive">
                             <table class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>Back</th>
                                  <th>Delete</th>
                                </tr>
                              </thead>
                               <tbody>
                                 <tr>
                                   <td><a href="{{ route('admin.index') }}" class="glyphicon glyphicon-menu-left go-back-ghost" style=" text-decoration:none;"></a></td>
                                   <td>
                                      <button type="button" class="btn glyphicon reject-ghost glyphicon-trash" data-toggle="modal" data-target="#Vehicle_rent_reject_modal"> Reject</button>
                                      <!-- conform delete modal -->
                                       <div class="modal fade" tabindex="-1" role="dialog" id="Vehicle_rent_reject_modal">
                                           <div class="modal-dialog" role="document">
                                               <div class="modal-content">
                                                   <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                   </div>
                                                   <div class="modal-body">
                                                        <p style="color: red;">If you Reject it, you can not recover it,So if you Are you Sure then enter yes???</p>
                                                        <form class="form-horizontal" method="POST" id="Vehicle_rent_book_reject_form" action="{{ route('admin.vehicle.book.request.reject') }}">
                                                            {{ csrf_field() }}
                                                            <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
                                                                <label for="user" class="col-md-4 control-label"></label>
                                                                <div class="col-md-6">
                                                                     <input id="user" type="hidden" class="form-control" name="user" value="{{ $VehicleBookRentRequest->email }}" placeholder="Ex: xx@xx.com" readonly>
                                                                       @if ($errors->has('user'))
                                                                         <span class="help-block">
                                                                            <strong>{{ $errors->first('user') }}</strong>
                                                                        </span>
                                                                      @endif
                                                                 </div>
                                                            </div>
                                                            <div class="form-group{{ $errors->has('VehicleBookRentRequest_id_reject') ? ' has-error' : '' }}">
                                                                <label for="VehicleBookRentRequest_id_reject" class="col-md-4 control-label"></label>
                                                                <div class="col-md-6">
                                                                    <input id="VehicleBookRentRequest_id_reject" type="hidden" class="form-control" name="VehicleBookRentRequest_id_reject" value="{{ $VehicleBookRentRequest->id }}" placeholder="Ex: 1" min="1" max="{{ $VehicleBookRentRequest->id }}" readonly>
                                                                    @if ($errors->has('VehicleBookRentRequest_id_reject'))
                                                                     <span class="help-block">
                                                                        <strong>{{ $errors->first('VehicleBookRentRequest_id_reject') }}</strong>
                                                                    </span>
                                                                  @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group{{ $errors->has('admins_email') ? ' has-error' : '' }}">
                                                                <label for="admins_email" class="col-md-4 control-label"></label>
                                                                <div class="col-md-6">
                                                                    <input type="hidden" name="admins_email" readonly value="{{Auth::user()->email}}" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                  <button type="submit" class="btn submit-ghost">Yes</button>
                                                                 <button type="button" class="btn btn-danger" data-dismiss="modal"> No</button>
                                                            </div>  
                                                        </form>
                                                   </div>
                                             </div>
                                         </div>
                                      </div>
                                   </td>
                                 </tr>
                               </tbody>
                             </table>
                           </div>
   
                        </div>                    
                        </div> 
                    </div>
                  @endif
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
    // Guest member
    function GuestTotalPriceCalculate() {
            var vehicle_amount = document.getElementById('vehicle_amount').value; 
            var hidden_price = document.getElementById('hidden_price').value;
            var price = document.getElementById('price'); 
            var total_price = hidden_price * vehicle_amount;
             document.getElementById('price').value = total_price.toFixed(2);
          }

      // Reg member 
    $('#calculate_with_offer_button').hide();
    function RegTotalPriceCalculate() {
            var vehicle_amount = document.getElementById('vehicle_amount').value; 
            var hidden_price = document.getElementById('hidden_price').value;
            var member_offer_range = document.getElementById('member_offer_range').value;
            var total_price = hidden_price * vehicle_amount;
             document.getElementById('price').value = total_price.toFixed(2);
             if (total_price >= member_offer_range) {
              $('#calculate_with_offer_button').show();
              $('#calculate').hide();
             }
             else{
              $('#calculate').hide();
             }
          }
    function RegTotalPriceCalculateWithOffer() {
            var price = document.getElementById('price').value;
            var member_offer = document.getElementById('member_offer').value;
            var offer= member_offer/100;
            var total_price_offer = price * offer;
            var member_total_price = price - total_price_offer;
             document.getElementById('price').value = member_total_price.toFixed(2);
              $('#calculate_with_offer_button').hide();
          }

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
    $("#Vehicle_rent_form").validate({
      rules:{
         name:{
          required:true,
          maxlength:100,
          latter_with_space:true
        },
         mobile:{
          required:true,
          maxlength:112,
          mobile_no:true
        },
        email:{
          required:true,
          maxlength:50,
          email:true
        },
        journey_date:{
          required:true,
          date:true
        },
        return_date:{
          required:true,
          date:true
        },
        description:{
          required:true
        },
        vehicle_amount:{
          required:true,
          number:true
        },
        vehicle_type:{
          required:true,
          maxlength:10,
          number:true,
          min:1
        },
        route:{
          required:true,
          maxlength:10,
          number:true,
          min:1
        },
        price:{
          required:true,
          maxlength:10,
          number:true
        }

      },
      messages:{
        name:{
          required:"This is required.",
          maxlength:"Enter a max char 100."
        },
          mobile:{
          required:"This is required.",
          maxlength:"Enter a max char 112."
        },
        email:{
          required:"This is required.",
          email:"Enter a valid email."
        },
        journey_date:{
          required:"This is required.",
          date:"Date format must (YYYY-MM-DD)."
        },
         return_date:{
          required:"This is required.",
          date:"Date format must (YYYY-MM-DD)."
        },
        description:{
          required:"This is required."
        },
         vehicle_amount:{
          required:"This is required.",
          max:"Book Rent can't be more then total vehicle."
        },
        vehicle_type:{
          required:"Vehicle type is required.",
          maxlength:"Max length 10"
        },
        route:{
          required:"Event name amount is required.",
          maxlength:"Max length 50"
        },
        price:{
          required:"Price is required.",
          maxlength:"Max length 10"
        }

        }
    });
    $("#Vehicle_rent_book_reject_form").validate({
      rules:{
           user:{
              required:true,
              email: true,
              maxlength:50
             },
           admins_email:{
              required:true,
              email: true,
              maxlength:50
            },
           GuestVehicleBookRentRequest_id_reject:{
              required:true,
            }
        },
        messages:{
          GuestVehicleBookRentRequest_id_reject:{
              required:"Vehicle book rent request id required."
             }
        }
    });
  // Allow any latter with space method
   jQuery.validator.addMethod("latter_with_space", function(value, element) {
  
    return this.optional( element ) || /^[A-Za-z ]*$/.test( value );
    }, 'Only Latter characters with space are allow.');

   // Allow any mobile method
   jQuery.validator.addMethod("mobile_no", function(value, element) {
  
    return this.optional( element ) || /^[0-9+,-]*$/.test( value );
    }, 'Only mobile no are allow.');

    // Time out for  <span class="help-block"> </span>
  setTimeout(function(){

        $("span.help-block").remove();
   }, 3500 );

      // Time out for  <div class="alert"> </span>
  setTimeout(function(){

        $("div.alert").remove();
   }, 3500 );
  
   </script>
@endsection
