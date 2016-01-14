@extends('layout.general')

@section('body_class')
@parent
trees-view-page tree-page-{{$tree->id}}
@endsection

@section('title','Tree - '.$tree->title)

@section('content')

<div class="row">
	<div class="col-lg-12 col-md-12 argue-tree-container">
		<div class="argue-tree-vis" data-tree-id="{{$tree->id}}">
			<ul>
				@include('visualisation.leaf',['node'=>$tree])
			</ul>
		</div>
	</div>
</div>

@endsection