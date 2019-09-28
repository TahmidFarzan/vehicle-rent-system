@extends('layouts.app_admin')

@section('title')
VRS Feedback
@endsection

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Admin</h1>
                    <!-- Message -->
                     @include('message.message_block')
                </div>
                
            </div>

            <div class="row">
                <!-- Right side -->
                <div class="col-lg-9">
                    <!-- List -->

                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-dashboard fa-fw"></i> Feedback</div>
                      <div class="panel-body">
                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover">
                           <thead>
                            <tr>
                             <th>Sender name</th>
                             <th>Membership</th>
                             <th>View</th>
                             <th>Delete</th>
                            </tr>
                           </thead>
                           <tbody>
                             @forelse($Feedback as $feedback)
                             <tr>
                               <td><b><p>{{ $feedback->name }}</p></b></td>
                               <td>
                                 @foreach($User as $user)
                                   @if($user->email==$feedback->email)
                                      Register user
                                   @endif

                                   @if($user->email!=$feedback->email)
                                     Guest user
                                   @endif
                                 @endforeach
                               </td>
                               <td><a href="{{route('admin-feedback.show',['id'=>$feedback->id])}}" class="glyphicon glyphicon-eye-open view-ghost"></a></td>
                               <td><button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                <!-- conform delete modal -->
                                {!! Form::open(array('route' => ['admin-feedback.destroy',$feedback->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                  @include('message.delete_conformation')
                                {!! Form::close() !!}
                               </td>
                               
                             </tr>
                             @empty
                              <tr>
                                <td colspan="4"><center><p style="color: #6F7823;">No destinatione details found</p></center></td>
                              </tr>
                             @endforelse 
                           </tbody>

                         </table>
                          {!! $Feedback->appends(Request::all())->render() !!}
                       </div>
                        </div>
                    </div>


                </div>
                <!-- Left side -->
                @include('admin.feedback.feedback_index')
               
            </div>
           
</div>
<script type="text/javascript">
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
