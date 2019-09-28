@extends('layouts.app_admin')

@section('title')
VRS Home Slider
@endsection

@section('content')
    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Admin</h1>
                    <!-- Messages -->
                    
                </div>
                
            </div>
            
            <div class="row">
               <!-- Right side -->
                <div class="col-lg-9">
                     
                    <!-- View -->
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-table fa-fw"></i> Home Slider View</div>
                      <div class="panel-body">
                        <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th><center><img src="{{ asset('image/home/slider/'.$HomeSlider->slider_name) }}" alt="{{ $HomeSlider->slider_alt }}" class="img-responsive" width="300px" height="275px"></center></th>
                            </tr>
                          </thead>
                         </table>
                       </div>
                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>Slider Name</th>
                              <th>Slider Url</th>
                              <th>Slider Sequence</th>
                              <th>Slider alt text</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>{{ $HomeSlider->slider_name }}</td>
                              <td>{{ $HomeSlider->slider_url }}</td>
                              <td>{{ $HomeSlider->slider_sequence }}</td>
                              <td>{{ $HomeSlider->slider_alt }}</td>
                             
                            </tr>
                          </tbody>

                         </table>
                       </div>

                       <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" >
                           <thead>
                            <tr>
                              <th>Add by</th>
                              <th>Add date</th>
                              <th>Edit</th>
                              <th>Delete</th>
                            </tr>
                           </thead>
                           <tbody>
                            <tr>
                              <td>{{ $HomeSlider->admin->name}}</td>
                              <td>{{ $HomeSlider->created_at}}<br/>({{ $HomeSlider->created_at->diffForHumans() }})</td>
                              <td><a href="{{ route('admin-home_slider.edit', ['id'=>$HomeSlider->id]) }}" class="glyphicon glyphicon-pencil edit-ghost" style=" text-decoration:none; float: left;"></a></td>
                              <td><button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                <!-- conform delete modal -->
                                 {!! Form::open(array('route' => ['admin-home_slider.destroy',$HomeSlider->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                       @include('message.delete_conformation')
                                 {!! Form::close() !!}</td>
                            </tr>
                           </tbody>
                           <tfoot>
                            <tr>
                              <td colspan="4"><center><a href="{{ route('admin-home_slider.index') }}" class="glyphicon glyphicon-menu-left go-back-ghost" style=" text-decoration:none;"></a></center></td>
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
