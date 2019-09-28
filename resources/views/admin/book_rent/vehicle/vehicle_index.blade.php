@extends('layouts.app_admin')

@section('title')
VSR vehicle book
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
                  <!--Guest List -->
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-dashboard fa-fw"></i>Book rent List</div>
                      <div class="panel-body">
                        <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                                 <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Show</th>
                                    <th>Delete</th>
                                 </tr>
                             </thead>
                             <tbody>
                               @forelse($VehicleBookRent as $vbr)
                               <tr>
                               <td><b>{{$vbr->name }}</b></td>
                               <td>{{ $vbr->email }}</td>
                               <td><a href="{{route('admin-vehicle_book_rent.show',['id'=>$vbr->id])}}" class="glyphicon glyphicon-eye-open view-ghost" style=" text-decoration:none;"></a></td>
                                <td><button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                  <!-- conform delete modal -->
                                  {!! Form::open(array('route' => ['admin-vehicle_book_rent.destroy',$vbr->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                       @include('message.delete_conformation')
                                  {!! Form::close() !!}
                                 </td>
                                 
                                 </tr>
                                @empty
                                   <tr class="empty"><td colspan="5"><p>No vehicle added.</p></td></tr>
                                @endforelse
                             </tbody>
                           </table>
                            <center>{!! $VehicleBookRent->appends(Request::all())->render() !!}</center>
                        </div>
                      </div>   
                    </div>
                    

                </div>
                <!-- Left side -->
                @include('admin.feedback.feedback_index')
            </div>
            
</div>
<script type="text/javascript">
      // Time out for  <div class="alert"> </span>
  setTimeout(function(){

        $("div.alert").remove();
   }, 3500 );
</script>

@endsection
