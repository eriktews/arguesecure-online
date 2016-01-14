@extends('layout.general')

@section('body_class')
@parent
attacks-view-page attacks-page-{{$attack->id}}
@endsection

@section('title','Attack - '.$attack->title)

@section('content')

<div class="row">
	<div class="col-lg-12 col-md-12 argue-tree-container">
		<div class="argue-tree-vis" data-tree-id="{{$attack->tree->id}}">
			<ul>
				@include('visualisation.leaf',['node'=>$attack])
			</ul>
		</div>
	</div>
</div>

@endsection