@extends('layouts.app_admin')

@section('title')
Deshboard
@endsection

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                    <!-- Message -->
                     @include('message.message_block')
                </div>
                
            </div>
            
            <div class="row">
                <!-- Right side -->
                <div class="col-lg-9">
                  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                      <!-- Event -->
                      <div class="panel panel-default">
                           <div class="panel-heading" role="tab" id="headingOne">
                               <h4 class="panel-title">
                                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                   Event
                                  </a>
                               </h4>
                           </div>
                           <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class="panel panel-default">
                                      <div class="panel-body">
                                          <div class="table-responsive">
                                              <table class="table table-striped table-bordered table-hover">
                                                   <thead>
                                                          <tr>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Membership</th>
                                                            <th>Show</th>
                                                          </tr>
                                                   </thead>
                                                   <tbody>
                                                        @forelse($EventBookRentRequest as $ebr)
                                                               <tr>
                                                                 <td>{{ $ebr->name }}</td>
                                                                 <td>{{ $ebr->email }}</td>
                                                                 <td>
                                                                  @foreach($User as $user)
                                                                   @if($user==$ebr->email)
                                                                     Register
                                                                   @endif
                                                                  @endforeach
                                                                 </td>
                                                                 <td>
                                                                    <a href="{{route('admin.event.book.request.detail',['id'=>$ebr->id])}}" class="glyphicon glyphicon-eye-open view-ghost" style=" text-decoration:none;"></a>
                                                                 </td>
                                                              </tr>
                                                        @empty
                                                           <tr class="empty">
                                                              <td colspan="4"><p>No vehicle added.</p></td>
                                                           </tr>
                                                        @endforelse
                                                   </tbody>
                                              </table>
                                              @if($EventBookRentRequest->count()>=5)
                                               <div class="panel-body table-responsive">
                                                   <center><a href="{{route('admin.event.book.request.list')}}" class="glyphicon glyphicon-eye-open view-all-ghost" target="_blank"> View all</a></center>
                                               </div> 
                                              @endif
                                          </div>
                                     </div>
                                    </div>
                                </div>
                           </div>
                      </div>
                      <!-- Vehicle -->
                      <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="headingTwo">
                              <h4 class="panel-title">
                                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                  Vehicle
                                 </a>
                              </h4>
                          </div>
                          <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <div class="panel panel-default">
                                   
                                      <div class="panel-body">
                                        <div class="table-responsive">
                                                   <table class="table table-striped table-bordered table-hover">
                                                                <thead>
                                                                      <tr>
                                                                         <th>Name</th>
                                                                         <th>Email</th>
                                                                         <th>Membership</th>
                                                                         <th>Show</th>
                                                                       </tr>
                                                                </thead>
                                                                <tbody>
                                                                      @forelse($VehicleBookRentRequest as $vbr)
                                                                           <tr>
                                                                              <td>{{ $vbr->name }}</td>
                                                                              <td>{{ $vbr->email }}</td>
                                                                                <td>
                                                                                  @foreach($User as $user)
                                                                                   @if($user==$vbr->email)
                                                                                      Regester 
                                                                                   @endif
                                                                                  @endforeach
                                                                                </td>
                                                                              <td><a href="{{route('admin.show',['id'=>$vbr->id])}}" class="glyphicon glyphicon-eye-open view-ghost" style=" text-decoration:none;"></a></td>
                                                                          
                                                                           </tr>
                                                                      @empty
                                                                           <tr class="empty">
                                                                               <td colspan="4"><p>No vehicle added.</p></td>
                                                                            </tr>
                                                                    @endforelse
                                                               </tbody>
                                                   </table>
                                                   @if($VehicleBookRentRequest->count()>=5)
                                                       <div class="panel-body table-responsive">
                                                           <center><a href="{{route('admin.vehicle.book.request.list')}}" class="glyphicon glyphicon-eye-open view-all-ghost" target="_blank"> View all</a></center>
                                                      </div> 
                                                   @endif
                                     </div>
                                     </div>
                                    </div>
                                </div>
                          </div>
                      </div>
 
                 </div>
                </div>
                <!-- Left side -->
               @include('admin.feedback.feedback_index')
            </div>
            
</div>


<!-- Jquery -->

<script type="text/javascript">
      // Time out for  <div class="alert"> </span>
  setTimeout(function(){

        $("div.alert").remove();
   }, 3500 );
</script>


@endsection
