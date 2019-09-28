@extends('layouts.app_admin')

@section('title')
VRS Rent mail
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

                  <!-- List -->
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-dashboard fa-fw"></i>Rent mail List</div>
                      <div class="panel-body">
                        <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                                 <tr>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Show</th>
                                    <th>Delete</th>
                                 </tr>
                             </thead>
                             <tbody>
                               @forelse($RentMail as $rm)
                               <tr>
                               <td><b>{{$rm->from }}</b></td>
                               <td>{{ $rm->to }}</td>
                               <td><a href="{{route('admin-rent_mail.show',['id'=>$rm->id])}}" class="glyphicon glyphicon-eye-open view-ghost" style=" text-decoration:none;"></a></td>
                                <td><button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                  <!-- conform delete modal -->
                                  {!! Form::open(array('route' => ['admin-rent_mail.destroy',$rm->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                       @include('message.delete_conformation')
                                  {!! Form::close() !!}
                                 </td>
                                 </tr>
                                @empty
                                   <tr class="empty"><td colspan="5"><p>No Rent mail.</p></td></tr>
                                @endforelse
                             </tbody>
                           </table>
                            {!! $RentMail->appends(Request::all())->render() !!}
                        </div>
                      </div>   
                    </div>
                    

                </div>
                <!-- Left side -->
                @include('admin.feedback.feedback_index')
            </div>
            
</div>


<script type="text/javascript">

  setTimeout(function(){

        $("div.alert").remove();
    }, 3500 );

  // Time out for  <span class="help-block"> </div>
  setTimeout(function(){

        $("span.help-block").remove();
    }, 3500 );
    
</script>


@endsection
