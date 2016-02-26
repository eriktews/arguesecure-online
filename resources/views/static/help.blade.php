@extends('layout.general')

@section('body_class')
@parent
help-page
@endsection

@section('title','Help')

@section('content')

<div class="panel panel-bordered argue-tree">
	<div class="panel-heading">
		<h3 class="panel-title">Title - optional</h3>
	</div>
	<div class="panel-body argue-tree-description">
		HELP GOES HERE
	</div>
	<div class="panel-footer">
		Footer - optional
		<div>
            <a href={{route('instructions')}} target="_blank">Click here to read the instructions</a>
        </div>
	</div>
</div>

@endsection