	<div class="panel argue-tree-vis-leaf argue-{{TreeNode::get($node,'type')}}" data-type="{{TreeNode::get($node,'type')}}" data-{{TreeNode::get($node,'type')}}-id="{{$node->id}}">
		<div class="panel-heading">
			<h3 class="panel-title node-title">
				@if (!$node->children->isEmpty())
				<i class="argue-node-collapse-toggle argue-node-toggle tooltip-dark fa fa-minus" data-toggle="tooltip" data-placement="top" title="Collapse Node"></i>
				@endif
				<div class="input-switch">
					<i class="argue-node-icon {{TreeNode::get($node,'icon')}}" data-toggle="tooltip" data-placement="top" title="{{ucfirst(TreeNode::get($node, 'name'))}}"></i>
					<span class="node-title">{{$node->title}}</span>
					<input name="title"/>
					<div class="loading"></div>
				</div>
			</h3>
			@if(Gate::allows('show', $node) || Gate::allows('edit', $node) || Gate::allows('destroy', $node))
			<ul class="panel-actions argue-node-actions">
				@if(TreeNode::get($node,'create'))
			    @can ('append', $node)
			    <li class="argue-node-action"><a class="argue-node-action-create btn btn-icon btn-outline btn-primary tooltip-primary" data-toggle="tooltip" data-placement="top" href="{{route(TreeNode::get(TreeNode::get($node,'create'),'route').'.create',[TreeNode::get($node,'type')=>$node->id])}}" title="Add {{ucfirst(TreeNode::get($node,'create'))}}"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
				@endcan
				@endif
				@if(TreeNode::get($node,'type') != "tree")
				@can ('show', $node)
			    <li class="argue-node-action"><a class="argue-node-action-create btn btn-icon btn-outline btn-success tooltip-success" data-toggle="tooltip" data-placement="top" href="{{route(TreeNode::get($node,'route').'.show', [TreeNode::get($node,'parent')=>$node->parent_id, TreeNode::get('type', $node)=>$node->id])}}" title="Open {{ucfirst(TreeNode::get($node,'name'))}}"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
				@endcan
				@endif
			    @can ('edit', $node)
			    <li class="argue-node-action"><a class="argue-node-action-edit btn btn-icon btn-outline btn-info tooltip-info" data-toggle="tooltip" data-placement="top" href="{{route(TreeNode::get($node,'route').'.edit', [TreeNode::get($node,'parent')=>$node->parent_id, TreeNode::get('type', $node)=>$node->id])}}" title="Edit {{ucfirst(TreeNode::get($node,'name'))}}"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
			    @endcan
			    @if(TreeNode::get($node,'type') != "tree")
			    @can ('destroy', $node)
				<li class="argue-node-action">
					{!! Form::open(['route'=>[TreeNode::get($node,'route').'.destroy',$node->parent_id, $node->id], 'method'=>'delete', 'class'=>'argue-node-action-delete-form', 'data-type'=> TreeNode::get($node,'type'), 'data-id'=>$node->id]) !!}
					<button type="submit" class="argue-node-action argue-node-action-destroy btn btn-icon btn-outline btn-danger tooltip-danger" data-toggle="tooltip" data-placement="top" title="Delete {{ucfirst(TreeNode::get($node,'name'))}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
					{!! Form::close() !!}
				</li>
				@endcan
				@endif
			</ul>
	  		@endif
		</div>
		<div class="panel-body argue-node-body">
			<div class="node-label">
				@foreach ($node->tags as $tag)
				<span class="label label-primary" data-tag-id="{{$tag->id}}" @if($tag->color) style="background-color: {{$tag->color}} !important" @endif>{{$tag->title}}</span>
				@endforeach
			</div>
			@if(!empty($node->description))
			<div class="node-description input-switch">
				<div class="loading"></div>
				<span class="node-description">{{$node->description}}</span>
				<input name="description">
			</div>
			@endif
	  	</div>
	  	<div class="panel-footer argue-node-footer">
	  		<div class="argue-node-action-wrapper">
				@if(!empty($node->description))
	  			<i class="argue-node-description-toggle argue-node-toggle tooltip-dark fa fa-sticky-note" data-toggle="tooltip" data-placement="top" title="Show Description"></i>
	  			@endif
	  			<i class="argue-node-action-toggle argue-node-toggle tooltip-dark fa fa-wrench" data-toggle="tooltip" data-placement="top" title="Show Actions"></i>
	  		</div>
	  		<div class="node-last-updated">Last updated by: {{$node->updatedBy->name}}</div>
	  	</div>
	  	@if ( $node->locked && (auth()->user()->id != $node->updated_by) )
        <div class="node-lock"></div>
        @endif
  	</div>