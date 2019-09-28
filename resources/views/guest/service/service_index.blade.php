@extends('layouts.app')

@section('title')
Service
@endsection

@section('content')
<div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-default">
            <div class="panel-body">
             <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
               @forelse($Service as $ser)
                 <div class="panel panel-default">
                   <div class="panel-heading" role="tab" id="heading-{{$ser->id}}">
                       <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" href="#collapse-{{$ser->id}}" aria-expanded="false" aria-controls="collapse-{{$ser->id}}" data-parent="#accordion">
                        {{$ser->name }}
                        </a>
                       </h4>
                    </div>
                    <div id="collapse-{{$ser->id}}" class="collapse" role="tabpanel" aria-labelledby="heading-{{$ser->id}}">
                          <div class="panel-body">
                               {!!html_entity_decode($ser->description)!!}
                          </div>
                          <div class="panel-body">
                            <img src="{{ asset('image/service/'.$ser->image_name) }}" alt="No image" class="img-responsive">
                          </div>
                    </div>
                </div>
               @empty
                <div class="panel panel-default">
                      <div class="panel-body">
                          <h4 class="panel-heading">No route available</h4>
                      </div>
                  </div>
               @endforelse 
               <center>{!! $Service->appends(Request::all())->render() !!}</center> 
             </div>
           </div>
          </div>
        </div>
</div>

<!-- Jquery -->
<script src="{{asset('js/jquery-3.3.1.js')}}"></script>
<script type="text/javascript">

  
</script>
@endsection