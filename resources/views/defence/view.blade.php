@extends('layout.general')

@section('body_class')
@parent
defences-view-page defences-page-{{$defence->id}}
@endsection

@section('title','Defence - '.$defence->title)

@section('content')

<div class="row">
	<div class="col-lg-12 col-md-12 argue-tree-container">
		<div class="argue-tree-vis" data-tree-id="{{$defence->tree->id}}">
			<ul>
				@include('visualisation.leaf',['node'=>$defence])
			</ul>
		</div>
	</div>
</div>

@endsection