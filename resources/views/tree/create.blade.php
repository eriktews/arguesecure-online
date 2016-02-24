@extends('layout.general')

@section('body_class')
@parent
trees-create-page
@endsection

@section('title','Create Tree')

@section('content')

<div class="panel">
	
	<div class="panel-body container-fluid">

		{!! Form::model($tree = new \App\Tree(['public'=>1]), ['route' => 'tree.store', 'autocomplete'=>'off']) !!}
		
		@include('partials.tree_form')

		<div class="form-group">		
			{!! Form::submit('Save',['class'=>'btn btn-primary'])!!}
			<a href="{{URL::previous()}}" class="btn btn-danger">Back</a>
		</div>

	    {!! Form::close() !!}

	</div>
</div>


@endsection