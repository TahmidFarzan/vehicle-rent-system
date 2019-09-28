@extends('layouts.app')

@section('title')
Event
@endsection

@section('content')
    <div class="row">
           <p style="color: #FFFFFF">Event is a place where someone rent vehicle for event and also can book ticket.</p>
     </div>
     <div class="row">
        <center><h4 class="my-4 text-center"><p style="color: #FFFFFF">Event Gallery</p></h4></center>
     </div>
     <div class="row text-center text-lg-left">
         @forelse($EventDetail as $ed)
           <div class="col-lg-3 col-md-4 col-xs-6 my-caption">
             <a href="{{route('event.show',['id'=>$ed->id])}}" class="d-block mb-4 h-100">
                 <img class="img-fluid img-thumbnail" src="{{ asset('image/event/'.$ed->image_name) }}" alt="No image"></a><p>{{ $ed->name }}</p> 
          </div>
         @empty
          <div class="col-lg-3 col-md-4 col-xs-6">
             <p class="empty">No event avable now.</p>
          </div>
         @endforelse
     </div>


@endsection
