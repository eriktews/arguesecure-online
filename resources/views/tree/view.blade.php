@extends('layout.general')

@section('body_class')
@parent
trees-view-page tree-page-{{$tree->id}}
@endsection

@section('title','Tree - '.$tree->title)

@section('content')

<div class="row auto-clear">
	<div class="col-md-12 argue-tree-container">
		<div class="argue-tree-vis">
			@include('visualisation.tree',['node'=>$tree])
		</div>
	</div>
</div>

@endsection