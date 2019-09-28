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
                  <!-- Guest -->
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-dashboard fa-fw"></i>Event request Dashboard </div>
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
                                                                     @if($user->email==$ebr->email)
                                                                      Regester 
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
                           {!! $EventBookRentRequest->appends(Request::all())->render() !!}
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
