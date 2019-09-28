@extends('layouts.app')

@section('title')
User setting
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-md-offset-1">
           <div class="panel-body">@include('message.message_block')</div>
            <div class="panel panel-default">
                <div class="panel-body">
                         <div class="table-responsive">
                             <table class="table table-striped table-bordered table-hover">
                               <tbody>
                                 @foreach($User as $user)
                                    @if($user->id==Auth::user()->id)
                                      <tr>
                                        <td>Name</td>
                                        <td>:</td>
                                        <td>{{$user->name}}</td>
                                      </tr>
                                      <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{$user->email}}</td>
                                      </tr>
                                      <tr>
                                        <td>Password</td>
                                        <td>:</td>
                                        <td>*********</td>
                                      </tr>
                                      <tr>
                                        <td>Edit</td>
                                        <td>:</td>
                                        <td><a href="{{route('user_setting.edit',['id'=>$user->id])}}" class="glyphicon glyphicon-pencil edit-ghost" style=" text-decoration:none;">
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
    </div>
</div>

   <!-- Hand made Jquery -->
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
