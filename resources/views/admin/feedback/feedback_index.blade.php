<div class="col-lg-3">
    <!-- Public Feedback -->
    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-bell fa-fw"></i> Feedback</div>
        <div class="panel-body">
            @forelse($Feedback as $feedback)
            <div class="list-group">
                <div class="table-responsive">
                  <a href="{{route('admin-feedback.show',['id'=>$feedback->id])}}" class="glyphicon glyphicon-envelope"><em> {{$feedback->name}}</em></a>
                    <em class="pull-right text-muted small">{{ $feedback->created_at->diffForHumans() }}</em>
                </div>
            </div>
            
            @empty
             <div class="list-group">
                <div class="list-group-item table-responsive">
                    <i class="glyphicon glyphicon-envelope"> Empty</i>
                </div>
            </div>
            @endforelse
            @if($Feedback->count()>=1)
            <div class="panel-body table-responsive">
              <center><a href="{{route('admin-feedback.index')}}" class="glyphicon glyphicon-eye-open view-all-ghost" target="_blank"> View all</a></center>
            </div> 
            @endif                      
        </div>     
    </div>

                  
</div>