<li>
	<div class="argue-tree-vis-leaf argue-{{$node->node_type}}" data-{{$node->node_type}}-id="{{$node->id}}">
		{{$node->title}}
		<ul class="argue-tree-actions">
	        @can ('edit', $node)
	    	<li class="argue-tree-action"><a class="argue-tree-action-edit btn btn-icon btn-outline btn-info tooltip-info" data-toggle="tooltip" data-placement="top" href="{{route($node->node_route.'.edit', ['id'=>$node->id])}}" title="Edit Tree"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
	        @endcan
	        @can ('destroy', $node)
	    	<li class="argue-tree-action">
	    		{!! Form::open(['route'=>[$node->node_route.'.destroy',$node->id], 'method'=>'delete', 'class'=>'argue-tree-action-delete-form' ]) !!}
	    		<button type="submit" class="argue-tree-action argue-tree-action-destroy btn btn-icon btn-outline btn-danger tooltip-danger" data-toggle="tooltip" data-placement="top" title="Delete Tree"><i class="fa fa-trash" aria-hidden="true"></i></button>
	    		{!! Form::close() !!}
	    	</li>
	    	@endcan
	  	</ul>
	  	@if ( $node->locked && (auth()->user()->id != $node->updated_by) )
        <div class="tree-lock"></div>
        @endif
  	</div>