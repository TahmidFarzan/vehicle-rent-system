@extends('layouts.app_admin')

@section('title')
VSR Event
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
                  <!-- Show -->
                   <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> Event info</div>
                      <div class="panel-body">
                        <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th><center><img src="{{ asset('image/event/'.$EventDetail->image_name) }}" alt="No image" class="img-responsive" width="300px" height="275px"></center></th>
                            </tr>
                          </thead>
                         </table>
                       </div>
                        <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>Event Name</th>
                              <th>Event type</th>
                              <th>Event address</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>{{ $EventDetail->name }}</td>
                              <td>{{ $EventDetail->event_type->name }}</td>
                              <td>{{ $EventDetail->address }}</td>
                            </tr>
                          </tbody>

                         </table>
                       </div>

                        <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>Event start date</th>
                              <th>Event start time</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><input type="date" name="start_date" readonly class="form-control" value="{{ $EventDetail->start_date }}"></td>
                              <td><input type="time" name="start_time" readonly class="form-control" value="{{ $EventDetail->start_time }}"></td>
                            </tr>
                          </tbody>

                         </table>
                       </div>

                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>Event end date</th>
                              <th>Event end time</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><input type="date" name="end_date" readonly class="form-control" value="{{ $EventDetail->end_date }}"></td>
                              <td><input type="time" name="end_time" readonly class="form-control" value="{{ $EventDetail->end_time }}"></td>
                            </tr>
                          </tbody>

                         </table>
                       </div>
                      
                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>Descriptaion</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if($EventDetail->descriptaion==null)
                              <tr>
                                <td>Not added</td>
                              </tr>
                            @else
                              <tr>
                                <td>{!!html_entity_decode($EventDetail->descriptaion)!!}</td>
                              </tr>
                            @endif
                          </tbody>
                         </table>
                       </div>

                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>Organizar</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if($EventDetail->organizar==null||$EventDetail->organizar=='')
                              <tr>
                                <td>Not added</td>
                              </tr>
                            @else
                              <tr>
                                <td>{!!html_entity_decode($EventDetail->organizar)!!}</td>
                              </tr>
                            @endif
                          </tbody>
                         </table>
                       </div>
                       
                        <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>Patner</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if($EventDetail->patner==null||$EventDetail->patner=='')
                              <tr>
                                <td>Not added</td>
                              </tr>
                            @else
                              <tr>
                                <td>{!!html_entity_decode($EventDetail->patner)!!}</td>
                              </tr>
                            @endif
                          </tbody>
                         </table>
                       </div>

                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>Map</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><iframe src="{{ $EventDetail->map }}" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe></td>
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
                              <td>{{ $EventDetail->created_at}}<br/>({{ $EventDetail->created_at->diffForHumans() }})</td>
                              <td>{{ $EventDetail->admin->name }}</td>
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
                              <td><a href="{{ route('admin-event.edit', ['id'=>$EventDetail->id]) }}" class="glyphicon glyphicon-pencil edit-ghost" style=" text-decoration:none; float: left;"></a></td>
                              <td><button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                <!-- conform delete modal -->
                                 {!! Form::open(array('route' => ['admin-event.destroy',$EventDetail->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                       @include('message.delete_conformation')
                                 {!! Form::close() !!}</td>
                            </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="3"><center><a href="{{ route('admin-event.index') }}" class="glyphicon glyphicon-menu-left go-back-ghost" style=" text-decoration:none;"></a></center></td>
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
