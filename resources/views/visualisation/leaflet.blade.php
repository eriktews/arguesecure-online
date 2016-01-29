	<div class="panel argue-tree-vis-leaf argue-{{TreeNode::get($node,'type')}}" data-{{TreeNode::get($node,'type')}}-id="{{$node->id}}">
		<div class="panel-heading">
			<h3 class="panel-title node-title"><i class="argue-node-icon {{TreeNode::get($node,'icon')}}"></i>{{$node->title}}<i class="argue-node-action-toggle tooltip-dark fa fa-wrench" data-toggle="tooltip" data-placement="top" title="Show Actions"></i></h3>
			@if(Gate::allows('show', $node) || Gate::allows('edit', $node) || Gate::allows('destroy', $node))
			<ul class="panel-actions argue-node-actions">
				@if(TreeNode::get($node,'create'))
			    @can ('append', $node)
			    <li class="argue-node-action"><a class="argue-node-action-create btn btn-icon btn-outline btn-primary tooltip-primary" data-toggle="tooltip" data-placement="top" href="{{route(TreeNode::get(TreeNode::get($node,'create'),'route').'.create',[TreeNode::get($node,'type')=>$node->id])}}" title="Add {{ucfirst(TreeNode::get($node,'create'))}}"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
				@endcan
				@endif
				@can ('show', $node)
			    <li class="argue-node-action"><a class="argue-node-action-create btn btn-icon btn-outline btn-success tooltip-success" data-toggle="tooltip" data-placement="top" href="{{route(TreeNode::get($node,'route').'.show', [TreeNode::get($node,'parent')=>$node->parent_id, TreeNode::get('type', $node)=>$node->id])}}" title="Open {{ucfirst(TreeNode::get($node,'type'))}}"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
				@endcan
			    @can ('edit', $node)
			    <li class="argue-node-action"><a class="argue-node-action-edit btn btn-icon btn-outline btn-info tooltip-info" data-toggle="tooltip" data-placement="top" href="{{route(TreeNode::get($node,'route').'.edit', [TreeNode::get($node,'parent')=>$node->parent_id, TreeNode::get('type', $node)=>$node->id])}}" title="Edit {{ucfirst(TreeNode::get($node,'type'))}}"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
			    @endcan
			    @can ('destroy', $node)
				<li class="argue-node-action">
					{!! Form::open(['route'=>[TreeNode::get($node,'route').'.destroy',$node->parent_id, $node->id], 'method'=>'delete', 'class'=>'argue-node-action-delete-form', 'data-type'=> TreeNode::get($node,'type'), 'data-id'=>$node->id]) !!}
					<button type="submit" class="argue-node-action argue-node-action-destroy btn btn-icon btn-outline btn-danger tooltip-danger" data-toggle="tooltip" data-placement="top" title="Delete {{ucfirst(TreeNode::get($node,'type'))}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
					{!! Form::close() !!}
				</li>
				@endcan
			</ul>
	  		@endif
		</div>
		<div class="panel-body argue-node-body">
			<div class="node-label">
				@foreach ($node->tags as $tag)
				<span class="label label-primary" data-tag-id="{{$tag->id}}" @if($tag->color) style="background-color: {{$tag->color}} !important" @endif>{{$tag->title}}</span>
				@endforeach
			</div>
			<div class="node-description">
				{{$node->description}}
			</div>
	  	</div>
	  	@if ( $node->locked && (auth()->user()->id != $node->updated_by) )
        <div class="node-lock"></div>
        @endif
  	</div>