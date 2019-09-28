@extends('layouts.app_admin')

@section('title')
VRS Vehicle Rent
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
                  <!-- Add -->
                   <div class="panel panel-default">
                      <div class="panel-body">
                         <form class="form-horizontal" method="POST" id="Add_vehicle_price_form" action="{{ route('admin-vehicle_rent_price.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('route') ? ' has-error' : '' }}">
                               <label for="route" class="col-md-3 control-label"><p>Route</p></label>

                                <div class="col-md-6">

                                   <select class="form-control" id="route" name="route">
                                     <option value="">Please select route</option>
                                     @foreach($Route as $route)
                                     <option value="{{$route->id}}">({{$route->origin}}) - ({{$route->destination}})</option>

                                     @endforeach
                                   </select>
                                    
                                   
                                   @if ($errors->has('route'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('route') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>

                            <div class="form-group{{ $errors->has('vehicle_type') ? ' has-error' : '' }}">
                               <label for="vehicle_type" class="col-md-3 control-label"><p>Vehicle Type</p></label>

                                <div class="col-md-6">
                                   {{ Form::select('vehicle_type',$VehicleType, null, ['placeholder' => 'Please select vehicle type','class'=>'form-control','id'=>'vehicle_type']) }}

                                   @if ($errors->has('vehicle_type'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('vehicle_type') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>

                            <div class="form-group{{ $errors->has('route_distance') ? ' has-error' : '' }}">
                               <label for="route_distance" class="col-md-3 control-label"><p>Route Distance(Km)</p></label>

                                <div class="col-md-6">
                                  <input id="route_distance" type="number" class="form-control" name="route_distance" value="{{ old('route_distance') }}" placeholder="Ex: Farzan" min="0" readonly>

                                   @if ($errors->has('route_distance'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('route_distance') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>

                            <div class="form-group{{ $errors->has('per_Km_price') ? ' has-error' : '' }}">
                               <label for="per_Km_price" class="col-md-3 control-label"><p>Price(Per Km)</p></label>

                                <div class="col-md-6">
                                  <input id="per_Km_price" type="number" class="form-control" name="per_Km_price" value="{{ old('per_Km_price') }}" placeholder="Ex: 100" min="0">

                                   @if ($errors->has('per_Km_price'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('per_Km_price') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                                  <div class="col-md-2">
                                      <div class="col-md-6 col-md-offset-4">
                                         <a href="javascript: void(0)" onClick="DistancePriceCalculate()" class="btn submit-ghost glyphicon glyphicon-usd" id="distanc_price_calculate">
                                         Cal
                                         </a>
                                      </div>
                                  </div>
                            </div>

                            <div class="form-group{{ $errors->has('distance_price') ? ' has-error' : '' }}">
                               <label for="distance_price" class="col-md-3 control-label"><p>Distance price</p></label>

                                <div class="col-md-6">
                                  <input id="distance_price" type="number" class="form-control" name="distance_price" value="{{ old('distance_price') }}" placeholder="Ex: 100" min="0" readonly>

                                   @if ($errors->has('distance_price'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('distance_price') }}</strong>
                                       </span>
                                     @endif
                                </div>
                            </div>

                             <div class="form-group{{ $errors->has('rent_price') ? ' has-error' : '' }}">
                               <label for="rent_price" class="col-md-3 control-label"><p>Rent price</p></label>

                                <div class="col-md-6">
                                  <input id="rent_price" type="number" class="form-control" name="rent_price" value="{{ old('rent_price') }}" placeholder="Ex: 100" min="0">

                                   @if ($errors->has('rent_price'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('rent_price') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                             </div>

                              <div class="form-group{{ $errors->has('total_price') ? ' has-error' : '' }}">
                               <label for="total_price" class="col-md-3 control-label"><p>Total Price</p></label>

                                <div class="col-md-6">
                                  <input id="total_price" type="number" class="form-control" name="total_price" value="{{ old('total_price') }}" placeholder="Ex: 100" min="0" readonly>

                                   @if ($errors->has('total_price'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('total_price') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                                  <div class="col-md-2">
                                      <div class="col-md-6 col-md-offset-4">
                                         <a href="javascript: void(0)" onClick="TotalPriceCalculate()" class="btn submit-ghost glyphicon glyphicon-usd" id="Total_price_calculate">
                                         Cal
                                         </a>
                                      </div>
                                  </div>
                             </div>

                          
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn submit-ghost">
                                     Submit
                                   </button>
                               </div>
                             </div>
                          </form>
                      </div>
                         
                   </div>
                  <!-- List -->
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-dashboard fa-fw"></i>Event price List</div>
                      <div class="panel-body">
                        <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                                 <tr>
                                    <th>Route</th>
                                    <th>Vehicle type</th>
                                    <th>Show</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                 </tr>
                             </thead>
                             <tbody>
                               @forelse($VehicleRentPrice as $vrp)
                               <tr>
                               <td>({{$vrp->route->origin}}) - ({{$vrp->route->destination}})</td>
                               <td>{{ $vrp->vehicle_type->name }}</td>
                               <td><a href="{{route('admin-vehicle_rent_price.show',['id'=>$vrp->id])}}" class="glyphicon glyphicon-eye-open view-ghost" style=" text-decoration:none;"></a></td>
                                <td><button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                  <!-- conform delete modal -->
                                  {!! Form::open(array('route' => ['admin-vehicle_rent_price.destroy',$vrp->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                       @include('message.delete_conformation')
                                  {!! Form::close() !!}
                                 </td>
                                 <td>
                                  <a href="{{route('admin-vehicle_rent_price.edit',['id'=>$vrp->id])}}" class="glyphicon glyphicon-pencil edit-ghost" style=" text-decoration:none;"></a>
                                  </td>
                                 </tr>
                                @empty
                                   <tr class="empty"><td colspan="5"><p>No vehicle added.</p></td></tr>
                                @endforelse
                             </tbody>
                           </table>
                            {!! $VehicleRentPrice->appends(Request::all())->render() !!}
                        </div>
                      </div>   
                    </div>
                    

                </div>
                <!-- Left side -->
                @include('admin.feedback.feedback_index')
            </div>
            
</div>



<!-- Jquery -->
<script src="{{asset('js/jquery-3.3.1.js')}}"></script>
<!-- Jquery form validator -->
<script src="{{asset('js/jquery.validate.js')}}"></script>
<script src="{{asset('js/additional-methods.js')}}"></script>

<script type="text/javascript">

    //Distance found
    $(document).ready(function(){
        $(document).on('change','#route',function(){
           var id=$(this).val();
            $.ajax({
              type:'get',
               url:'{!! URL::to('admin/distance/found')!!}',
               data:{'id':id},
               success:function(data){
                   console.log(data);
                   $('#route_distance').val(data);
               },
               error:function(){
                console.log('Fail.');
                }
            });
         });

       });


// Desgine error message
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
    // Form validate 
        $('#Add_vehicle_price_form').validate({
          rules:{
            distance_price:{
              required:true,
              maxlength:10,
              number:true
            },
            rent_price:{
              required:true,
              maxlength:10,
              number:true
            },
             per_Km_price:{
              required:true,
              maxlength:10,
              number:true
            },
            route_distance:{
              required:true,
              maxlength:10,
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
            }
          },
          messages:{
             distance_price:{
              required:"This is required.",
              maxlength:"Max length 10"
             },
             rent_price:{
              required:"This is required.",
              maxlength:"Max length 10"
             },
             route_distance:{
              required:"This is required.",
              maxlength:"Max length 10"
             },
             vehicle_type:{
               required:"This is required.",
               maxlength:"Max length 10"
             },
              route:{
                required:"This is required.",
                maxlength:"Max length 50"
               }
            }
        });

  
  setTimeout(function(){

        $("div.alert").remove();
    }, 3500 );

  // Time out for  <span class="help-block"> </div>
  setTimeout(function(){

        $("span.help-block").remove();
    }, 3500 );
    
 function DistancePriceCalculate(){
           var per_Km_price = document.getElementById('per_Km_price').value;
           var route_distance = document.getElementById('route_distance').value;
           var total_distance_price = route_distance * per_Km_price;
           document.getElementById('distance_price').value = total_distance_price.toFixed(2);
 }

 function TotalPriceCalculate(){
           var rent_price = document.getElementById('rent_price').value;
           var distance_price = document.getElementById('distance_price').value;
           var total_price = parseFloat(rent_price) + parseFloat(distance_price);
           document.getElementById('total_price').value = total_price.toFixed(2);
 }
    
</script>


@endsection
