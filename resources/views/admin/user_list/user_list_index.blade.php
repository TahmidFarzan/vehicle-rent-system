@extends('layouts.app_admin')

@section('title')
VSR User List
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
                      <div class="panel-heading"><i class="fa fa-dashboard fa-fw"></i>Total {{$User->total()}} User </div>
                      <div class="panel-body">
                        <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                                 <tr>
                                    <th>User name</th>
                                    <th>User email</th>
                                 </tr>
                             </thead>
                             <tbody>
                               @forelse($User as $user)
                               <tr>
                                  <td><b>{{ $user->name }}</b></td>
                                  <td>{{ $user->email }}</td>
                                 </tr>
                                @empty
                                   <tr class="empty"><td colspan="3"><p>No vehicle added.</p></td></tr>
                                @endforelse
                             </tbody>
                           </table>
                            {!! $User->appends(Request::all())->render() !!}
                        </div>
                      </div>   
                    </div>
                    

                </div>
                <!-- Left side -->
                @include('admin.feedback.feedback_index')
            </div>
            
</div>
@endsection
