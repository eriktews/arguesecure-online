<li class="argue-{{TreeNode::get($node,'type')}}-wrapper" data-{{TreeNode::get($node,'type')}}-id="{{$node->id}}" data-{{TreeNode::get($node,'type')}}-locked="{{$node->locked}}">
	@include('visualisation.leaflet',['node'=>$node])
	@if ( ! $node->children->isEmpty() )
	<ul>
	@foreach($node->children as $child)
		@include('visualisation.leaf',['node'=>$child])
	@endforeach
	</ul>
	@endif
