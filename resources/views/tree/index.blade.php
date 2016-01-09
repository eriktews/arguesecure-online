@extends('layout.general')

@section('body_class')
@parent
trees-index-page
@endsection

@section('title','Trees')

@section('content')

<div class="row argue-tree-container auto-clear">
	@foreach($trees as $tree)
		@include('partials.tree', ['tree'=>$tree])
	@endforeach
</div>
<div class="row">
	<div>
	{!! $trees->render() !!}
	</div>
</div>
@endsection