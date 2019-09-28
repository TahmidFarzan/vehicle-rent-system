@extends('layouts.app')

@section('title')
Event-{{ $EventDetail->name }}
@endsection

@section('content')

<div class="row">
                <!-- Right side -->
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <input type="date" name="start_date" readonly value="{{ $EventDetail->start_date }}" width="auto"><td><input type="time" name="start_time" readonly value="{{ $EventDetail->start_time }}" width="auto"> to <input type="date" name="end_date" readonly  value="{{ $EventDetail->end_date }}"><input type="time" name="end_time" readonly value="{{ $EventDetail->end_time }}"> at
                            {{ $EventDetail->address }}
                        </div>
                        <div class="panel-body">
                           <img class="img-fluid img-thumbnail" src="{{ asset('image/event/'.$EventDetail->image_name) }}" alt="No image">
                        </div>
                        <div class="panel-body">
                           {!!html_entity_decode($EventDetail->descriptaion)!!}
                        </div>
                     </div>

                    @if($EventDetail->patner!=null)
                     <div class="panel panel-default">
                        <div class="panel-heading">Patner</div>
                        <div class="panel-body">
                           {!!html_entity_decode($EventDetail->patner)!!}
                        </div>
                     </div>
                     @endif

                </div>
                <!-- Left side -->
              <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-bell fa-fw"></i> Map</div>
                        <div class="panel-body">
                           <iframe src="{{ $EventDetail->map }}" frameborder="0" style="border:0" allowfullscreen"></iframe>        
                         </div>                 
                    </div> 

                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-bell fa-fw"></i> Organizar</div>
                        <div class="panel-body">
                            {!!html_entity_decode($EventDetail->organizar)!!}
                         </div>                 
                    </div>

                     <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-bell fa-fw"></i> Price(per day per vehicle)</div>
                        <div class="panel-body">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                @foreach($EventPriceDetail as $epd)
                                   @if($epd->event_detail_id==$EventDetail->id)
                                      <div class="panel panel-default" id="event_price_show">
                                        <div class="panel-heading" role="tab" id="heading-{{$epd->id}}">
                                            <h4 class="panel-title">
                                               <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$epd->id}}" aria-expanded="false" aria-controls="collapse-{{$epd->id}}">
                                                 {{$epd->vehicle_type->name}}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse-{{$epd->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-{{$epd->id}}">
                                            <div class="table-responsive"> 
                                                <table class="table table-striped table-bordered table-hover" >
                                                    <tbody>
                                                        <tr>
                                                            <td>Ticket price<br/>(per person)</td>
                                                            <td>Vehicle price</td>
                                                            <td>Total price</td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{$epd->ticket_price}}</td>
                                                            <td>{{$epd->vehicle_price}}</td>
                                                            <td>{{$epd->total_price}}</td>
                                                        </tr>
                                                   </tbody>
                                                   <tfoot>
                                                        <tr>
                                                            <td>Toll</td>
                                                            <td>:</td>
                                                            <td>Paid by client</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>  
                                            </div>
                                        </div>
                                    </div>
                                   @endif
                                @endforeach
                            </div>
                            <div id="event_price_empty">
                                  Price Not added yet.
                            </div>
                            
                         </div>                 
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <a href="{{route('all_user.event.instant.book',['id'=>$EventDetail->id])}}" class="btn btn-primary"> Book request</a>
                         </div>                 
                    </div>                 
             </div>

</div>

<!-- Jquery -->
<script src="{{asset('js/jquery-3.3.1.js')}}"></script>
<script type="text/javascript">

   // hide a div when another one is visible.
  $(document).ready(function(){

    if ($('#event_price_show').is(":visible")) {
        $('#event_price_empty').hide();
     }
    else {
       $('#event_price_empty').show();
    }

});
</script>
@endsection