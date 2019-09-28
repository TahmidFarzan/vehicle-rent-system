@extends('layouts.app')

@section('title')
About us
@endsection

@section('content')
<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel-body"></div>
                 <div class="panel panel-default">
                      <div class="panel-heading"><center><h3><p>About us</p></h3></center></div>
                        @foreach($AboutUs as $about)
                          <div class="panel-body">
                                  {!!html_entity_decode($about->description)!!}
                          </div>
                        @endforeach  
                 </div>
            </div>
           
        </div>
</div>


@endsection
