@extends('layouts.app_admin')

@section('title')
Home Slider
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
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> Slider info</div>
                      <div class="panel-body">
                         <form class="form-horizontal" method="POST" name="Add home slider form" id="Add_home_slider_form" action="{{ route('admin-home_slider.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('slider_sequence') ? ' has-error' : '' }}">
                               <label for="slider_sequence" class="col-md-4 control-label"><p>Slider sequence</p></label>

                                <div class="col-md-6">
                                  <input id="slider_sequence" type="number" class="form-control" name="slider_sequence" value="{{ old('slider_sequence') }}" placeholder="Ex: 1" min="1">
                                  <div id="slider_sequence_error" class="vrs-alert-danger"></div>
                                   @if ($errors->has('slider_sequence'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('slider_sequence') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>

                            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                               <label for="url" class="col-md-4 control-label"><p>Url</p></label>

                                <div class="col-md-6">
                                  <input id="url" type="url" class="form-control" name="url" value="{{ old('url') }}" placeholder="Ex: www.google.com">

                                   @if ($errors->has('url'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('url') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>

                            <div class="form-group{{ $errors->has('alt_text') ? ' has-error' : '' }}">
                               <label for="alt_text" class="col-md-4 control-label"><p>Imae alt text</p></label>

                                <div class="col-md-6">
                                  <input id="alt_text" type="text" class="form-control" name="alt_text" value="{{ old('alt_text') }}" placeholder="Ex: Hello">

                                   @if ($errors->has('alt_text'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('alt_text') }}</strong>
                                       </span>
                                     @endif
                                  </div>
                            </div>
                  

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                 <label for="address" class="col-md-4 control-label"><p>Image(450x450)</p></label>

                                  <div class="col-md-6">
                                     <input id="image" type="file" name="image" class="form-control">

                                      @if ($errors->has('image'))
                                       <span class="help-block">
                                          <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                       @endif
                                    </div>
                            </div>

                             <div class="form-group" id="image_preview_div">
                                 <label for="image_preview" class="col-md-4 control-label"><p></p></label>

                                  <div class="col-md-6">
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
                      <div class="panel-heading"><i class="fa fa-dashboard fa-fw"></i>Slider List</div>
                      <div class="panel-body">
                        <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover">
                             <thead>
                                 <tr>
                                    <th>Slider name</th>
                                    <th>Slider sequence</th>
                                    <th>Show</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                 </tr>
                             </thead>
                             <tbody>
                                @forelse($HomeSlider as $hs)
                               <tr>
                               <td><b>{{ $hs->slider_name }}</b></td>
                               <td>{{ $hs->slider_sequence }}</td>
                               <td><a href="{{route('admin-home_slider.show',['id'=>$hs->id])}}" class="glyphicon glyphicon-eye-open view-ghost" style=" text-decoration:none;"></a></td>
                                <td><button type="button" class="glyphicon delete-ghost glyphicon-trash" data-toggle="modal" data-target="#delete_conformation"></button>
                                  <!-- conform delete modal -->
                                  {!! Form::open(array('route' => ['admin-home_slider.destroy',$hs->id],'method'=>'DELETE','class'=>'form-horizontal')) !!}
                                       @include('message.delete_conformation')
                                  {!! Form::close() !!}
                                 </td>
                                 <td>
                                  <a href="{{route('admin-home_slider.edit',['id'=>$hs->id])}}" class="glyphicon glyphicon-pencil edit-ghost" style=" text-decoration:none;"></a>
                                  </td>
                                 </tr>
                                @empty
                                   <tr class="empty"><td colspan="5"><p>No home slider added.</p></td></tr>
                                @endforelse
                             </tbody>
                           </table>
                               {!! $HomeSlider->appends(Request::all())->render() !!}
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

<script type="text/javascript">
  // Jquery duplicate value validation
  $("#slider_sequence_error").hide();
       $(document).ready(function(){
        $('#slider_sequence').blur(function(){
           var id=$(this).val();
            $.ajax({
              type:'get',
               url:'{!! URL::to('admin/home-slider-sequence/duplicate/found')!!}',
               data:{'id':id},
               success:function(data){
                   $("#slider_sequence_error").show();
                   $('#slider_sequence_error').html("Same sequence exists.");
                   setTimeout(function(){
                              $("#slider_sequence_error").fadeOut("slow", function () {
                              $("#slider_sequence_error").hide();
                             });
                             }, 3500);
               },
               error:function(){
                console.log('Fail.');
                }
            });
         });

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
        $('#Add_home_slider_form').validate({
          rules:{
            url:{
              required:true,
              url:true
            },
             slider_sequence:{
              required:true,
              number:true,
              maxlength:10,
            },
              alt_text:{
              required:true,
              maxlength:100,
              latter_with_space_fullstop:true
            },
            image:{
              required:true,
              extension: "jpg|png|jpeg"
            }
          },
          messages:{
             url:{
              url:"Only url allow."
             },
             slider_sequence:{
              number:"Must be a number"
            },
            alt_text:{
              maxlength:"Max char 100.",
            },
            image:{
              extension: "Only Image allow."
            }
            }
        });

         // Allow any latter with spacebar and . characters method
          jQuery.validator.addMethod("latter_with_space_fullstop", function(value, element) {
              return this.optional( element ) || /^[A-Za-z .]+$/.test( value );
          }, 'Latter characters with space fullstop are allow.');


  setTimeout(function(){

        $("div.alert").remove();
    }, 3500 );

  // Time out for  <span class="help-block"> </span>
  setTimeout(function(){

        $("span.help-block").remove();
    }, 3500 );
    
</script>


@endsection
