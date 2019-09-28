@extends('layouts.app_admin')

@section('title')
VRS admin setting
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
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> Admin setting</div>
                      <div class="panel-body">
                         <div class="table-responsive">
                             <table class="table table-striped table-bordered table-hover">
                               <tbody>
                                 @foreach($Admin as $admin)
                                    @if($admin->id==Auth::user()->id)
                                      <tr>
                                         <td>Name:</td>
                                         <td>:</td>
                                         <td>{{$admin->name}}</td>
                                      </tr>
                                      <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{$admin->email}}</td>
                                      </tr>
                                      <tr>
                                        <td>Password</td>
                                        <td>:</td>
                                        <td>**********</td>
                                      </tr>
                                      <tr>
                                        <td>Edit</td>
                                        <td>:</td>
                                        <td><a href="{{route('admin_setting.edit',['id'=>$admin->id])}}" class="glyphicon glyphicon-pencil edit-ghost" style=" text-decoration:none;">
                                        </td>
                                      </tr>
                                    @endif
                                @endforeach
                               </tbody>
                             </table>
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

<script type="text/javascript">

// Time out for  <div class="alert "> </div>
  setTimeout(function(){

        $("div.alert").remove();
    }, 3500 );

  // Time out for  <span class="help-block"> </div>
  setTimeout(function(){

        $("span.help-block").remove();
    }, 3500 );
    
</script>


@endsection
