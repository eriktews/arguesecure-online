<ul>
	@include('visualisation.leaf',['node'=>$tree])
	<ul>
	@foreach($node->children as $child)
		<li>
			<ul>
			@include('visualisation.leaf',['node'=>$child])
			</ul>
			{{-- DO NOT INCLUDE LI - it causes a whitespace bug due to the implementation of the tree visualisation (uses inline-block) --}}
	@endforeach
	</ul>
</ul>