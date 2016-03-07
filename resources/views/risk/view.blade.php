@extends('layout.general')

@section('body_class')
@parent
risks-view-page risks-page-{{$risk->id}}
@endsection

@section('title','Risk - '.$risk->title)

@section('content')

<div class="row">
	<div class="col-lg-12 col-md-12 argue-tree-container">
		<div class="argue-tree-vis" data-tree-id="{{$risk->tree->id}}">
			<ul>
				@include('visualisation.leaf',['node'=>$risk])
			</ul>
		</div>
	</div>
</div>

@endsection