@extends('layout.treeview')

@section('body_class')
@parent
trees-view-page tree-page-{{$tree->id}}
@endsection

@section('title','Tree - '.$tree->title)

@section('content')

<div class="argue-tree-vis" data-tree-id="{{$tree->id}}">
	<ul>
		@include('visualisation.leaf',['node'=>$tree])
	</ul>
</div>

@endsection