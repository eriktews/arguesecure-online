<div class="col-xlg-4 col-md-6 argue-tree-wrapper" data-tree-id="{{$tree->id}}">
    <div class="panel panel-bordered argue-tree" data-tree-id="{{$tree->id}}" data-tree-locked="{{$tree->locked}}">
    	<div class="panel-heading">
    		<h3 class="panel-title"><a href="{{ route('tree.show', ['id' => $tree->id]) }}"><span class="argue-tree-title">{{$tree->title}}</span> - by <span class="argue-tree-user-name">{{$tree->user->name}}</span></a></h3>
    		<ul class="panel-actions argue-tree-actions">
            	<li class="argue-tree-action"><a class="argue-tree-action-show btn btn-icon btn-outline btn-success tooltip-success" data-toggle="tooltip" data-placement="top" href="{{route('tree.show', ['id'=>$tree->id])}}" title="Open Assessment"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                @can ('edit', $tree)
            	<li class="argue-tree-action"><a class="argue-tree-action-edit btn btn-icon btn-outline btn-info tooltip-info" data-toggle="tooltip" data-placement="top" href="{{route('tree.edit', ['id'=>$tree->id])}}" title="Edit Assessment"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                @endcan
                @can ('destroy', $tree)
            	<li class="argue-tree-action">
            		{!! Form::open(['route'=>['tree.destroy',$tree->id], 'method'=>'delete', 'class'=>'argue-tree-action-delete-form' ]) !!}
            		<button type="submit" class="argue-tree-action argue-tree-action-destroy btn btn-icon btn-outline btn-danger tooltip-danger" data-toggle="tooltip" data-placement="top" title="Delete Assessment"><i class="fa fa-trash" aria-hidden="true"></i></button>
            		{!! Form::close() !!}
            	</li>
            	@endcan
          	</ul>
    	</div>
    	<div class="panel-body argue-tree-description">
    		{{$tree->description}}
    	</div>
        @if ($tree->locked && (auth()->user()->id != $tree->user_id) )
        <div class="node-lock"></div>
        @endif
    </div>
</div>
