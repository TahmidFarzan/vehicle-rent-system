@extends('layouts.app_admin')

@section('title')
VRS Service
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
                   <!-- Add -->
                   <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> Service info</div>
                      <div class="panel-body">
                         <form class="form-horizontal" method="POST" name="Add service form" id="Add_service_form" action="{{ route('admin-service.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                               <label for="name" class="col-md-2 control-label"><p>Name</p></label>

                                  <div class="col-md-9">
                                   <input id="name" type="name" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ex: Farzan">
                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                     </span>
                                     @endif
                                     </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                 <label for="description" class="col-md-2 control-label"><p>Description</p></label>
                                  <div class="col-md-9 my-form-div">
                                     <textarea id="description" name="description" class="form-control textarea" placeholder="Helo" rows="7">
                                       {{ old('description') }}
                                     </textarea>
                                         <div class="{{ $errors->has('description') ? ' has-error' : '' }}">
                                               @if ($errors->has('description'))
                                                <span class="help-block">
                                                   <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                              @endif
                                         </div>
                                    </div>
                            </div>

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                 <label for="image" class="col-md-2 control-label"><p>Image(450x450)</p></label>

                                  <div class="col-md-9">
                                     <input id="image" type="file" name="image" class="form-control">

                                      @if ($errors->has('image'))
                                       <span class="help-block">
                                          <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                       @endif
                                    </div>
                            </div>

                             <div class="form-group" id="image_preview_div">
                                 <label for="image_preview" class="col-md-2 control-label"><p></p></label>

                                  <div class="col-md-9">
                                     <img name="image_preview" id="image_preview" class="thumbnail">

                                    </div>
                             </div>
                          
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn submit-ghost">
                                     Submit
                                   </button>
                               </div>
                             </div>
                          </form>
                      </div>    
                   </div>

                  <!-- List -->
                    <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-dashboard fa-fw"></i>Service list</div>
                      <div class="panel-body">
                        <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                                 <tr>
                                    <th>Name</th>
                                    <th>Show</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                 </tr>
                             </thead>
                             <tbody>
                              @forelse($Service as $service)
                              <tr>
                                    <td>{{$service->name }}</td>
                                    <td><a href="{{route('admin-service.show',['id'=>$service->id])}}" class="glyphicon glyphicon-eye-open view-ghost" style=" text-decoration:none;"></a></td>
                                    <td><a href="{{route('admin-service.edit',['id'=>$service->id])}}" class="glyphicon glyphicon-pencil edit-ghost" style=" text-decoration:none;"></td>
                                    <td>
                                      <button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                  <!-- conform delete modal -->
                                  {!! Form::open(array('route' => ['admin-service.destroy',$service->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                       @include('message.delete_conformation')
                                  {!! Form::close() !!}
                                </td>
                             </tr>
                               @empty
                                   <tr class="empty"><td colspan="4"><p>No vehicle added.</p></td></tr>
                              @endforelse
                             </tbody>
                           </table>
                              {!! $Service->appends(Request::all())->render() !!}
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
<!-- Jquery form validator -->
<script src="{{asset('js/jquery.validate.js')}}"></script>
<script src="{{asset('js/additional-methods.js')}}"></script>
 <!-- Jquery Rich text editor -->
 <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript">
  //Call rich text editor
tinymce.init({
  selector: 'textarea',
  height: 300,
  menubar: true,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code',
    'insertdatetime media table contextmenu paste code help wordcount emoticons pagebreak'
  ],
  toolbar: 'insert | table | undo redo | emoticons | pagebreak | formatselect | block | bold italic strikethrough underline forecolor backcolor | searchreplace | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | preview | paste | code',

  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css']
});

 // Preview image
      $("#image_preview_div").hide();
      document.getElementById("image").onchange = function () {
         var reader = new FileReader();
         reader.onload = function(e) {
          $("#image_preview_div").show();
             document.getElementById("image_preview").src = e.target.result;
             }
         reader.readAsDataURL(this.files[0]);
          }

// Desgine error message
    $.validator.setDefaults({
      errorClass:'help-block',
      highlight:function(element){
        $(element)
         .closest('.form-group')
         .addClass('has-error');
      },
      unhighlight:function(element){
        $(element)
         .closest('.form-group')
         .removeClass('has-error');
      }
    });
    // Form validate 
        $('#Add_service_form').validate({
          rules:{
             description:{
             required:true
            },
            name:{
                required:true,
                maxlength:100,
                latter_with_space:true
            },
             image:{
              required:true,
              extension: "jpg|png|jpeg"
            }
          },
          messages:{
            image:{
              extension: "Only Image allow."
            }
            }
        });

    // Allow any latter with space method
   jQuery.validator.addMethod("latter_with_space", function(value, element) {
  
    return this.optional( element ) || /^[A-Za-z ]*$/.test( value );
    }, 'Only Latter characters with space are allow.');

// Time out for  <div class="alert "> </div>
  setTimeout(function(){

        $("div.alert").remove();
    }, 3500 );

    // Time out for  <span class="help-block"> </span>
  setTimeout(function(){

        $("span.help-block").remove();
   }, 3500 );
</script>


@endsection
