@extends('layout.general')

@section('body_class')
@parent
defences-edit-page
@endsection

@section('title','Edit Defence')

@section('content')

<div class="panel">
	
	<div class="panel-body container-fluid">

		{!! Form::model($defence, ['route' => ['defence.update',$defence->parent_id, $defence->id], 'method'=>'put', 'autocomplete'=>'off']) !!}
		
		@include('partials.defence_form')

		<div class="form-group">		
			{!! Form::submit('Save',['class'=>'btn btn-primary'])!!}
			<a href="{{route('tree.show',[$defence->tree->id])}}" class="btn btn-danger">Back</a>
		</div>

	    {!! Form::close() !!}

	</div>
</div>


@endsection