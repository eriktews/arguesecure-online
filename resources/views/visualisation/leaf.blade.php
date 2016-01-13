<ul class="argue-{{$node->node_type}}-wrapper" data-{{$node->node_type}}-id="{{$node->id}}">
	@include('visualisation.leaflet',['node'=>$node])
	@if ( ! $node->children->isEmpty() )
	<ul>
	@foreach($node->children as $child)
		<li>
			<ul>
			@include('visualisation.leaflet',['node'=>$child])
			</ul>
			{{-- DO NOT INCLUDE LI - it causes a whitespace bug due to the implementation of the tree visualisation (uses inline-block) --}}
	@endforeach
	@endif
	</ul>
</ul>
