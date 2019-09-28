@extends('layouts.app_admin')

@section('title')
VSR About us
@endsection

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Admin panal</h1>
                    <!-- Message -->
                </div>
                
            </div>
            
            <div class="row">
                <!-- Right side -->
                <div class="col-lg-9">
                  <!-- Show -->
                   <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> About us info</div>
                      <div class="panel-body">
 
                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>Description</th>
                            </tr>
                          </thead>
                          <tbody>
                              <tr>
                                <td>{!!html_entity_decode($AboutUs->description)!!}</td>
                              </tr>
                          </tbody>
                         </table>
                       </div>

                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>Add date</th>
                              <th>Add by</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>{{ $AboutUs->created_at}}<br/>({{ $AboutUs->created_at->diffForHumans() }})</td>
                              <td>{{ $AboutUs->admin->name }}</td>
                            </tr>
                          </tbody>

                         </table>
                       </div>
                       
                        <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>Edit</th>
                              <th>Delete</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><a href="{{ route('admin-about_us.edit', ['id'=>$AboutUs->id]) }}" class="glyphicon glyphicon-pencil edit-ghost" style=" text-decoration:none; float: left;"></a></td>
                              <td><button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                <!-- conform delete modal -->
                                 {!! Form::open(array('route' => ['admin-about_us.destroy',$AboutUs->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                       @include('message.delete_conformation')
                                 {!! Form::close() !!}</td>
                            </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="3"><center><a href="{{ route('admin-about_us.index') }}" class="glyphicon glyphicon-menu-left go-back-ghost" style=" text-decoration:none;"></a></center></td>
                            </tr>
                           </tfoot>
                         </table>
                       </div>
                         
                      </div>    
                   </div>

                </div>
                <!-- Left side -->
                @include('admin.feedback.feedback_index') 
            </div>
            
</div>

@endsection
