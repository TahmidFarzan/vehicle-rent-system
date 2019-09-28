@extends('layouts.app')

@section('title')
Vehicle list
@endsection

@section('content')
<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                  @forelse($VehicleDetail as $vd )
                   <div class="media">
                      <div class="media-left media-middle">
                            <a href="{{route('vehicle-list.show',['id'=>$vd->id])}}"><img class="media-object" src="{{ asset('image/vehicle/'.$vd->image_name) }}" alt="No image" width="75px" height="75px"></a>
                      </div>
                      <div class="media-body">
                          <a href="{{route('vehicle-list.show',['id'=>$vd->id])}}"><h3 class="media-heading">{{$vd->name}}</h3></a>
                           {{$vd->licence_no}}
                      </div>
                   </div>
                   @empty
                   @endforelse
                </div>
                 <center>{!! $VehicleDetail->appends(Request::all())->render() !!}</center>
            </div>
        </div>
</div>

@endsection