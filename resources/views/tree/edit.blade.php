@extends('layout.general')

@section('body_class')
@parent
trees-edit-page
@endsection

@section('title','Edit Tree')

@section('content')

<div class="panel">
	
	<div class="panel-body container-fluid">

		{!! Form::model($tree, ['route' => ['tree.update', $tree->id], 'method'=>'put', 'autocomplete'=>'off']) !!}
		
		@include('partials.tree_form')

		<div class="form-group">		
			{!! Form::submit('Save',['class'=>'btn btn-primary'])!!}
			<a href="{{URL::previous()}}" class="btn btn-danger">Back</a>
		</div>

	    {!! Form::close() !!}

	</div>
</div>


@endsection