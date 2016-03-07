@extends('layout.general')

@section('body_class')
@parent
defences-create-page
@endsection

@section('title','Create Defence')

@section('content')

<div class="panel">
	
	<div class="panel-body container-fluid">

		{!! Form::model($defence = new \App\Defence(), ['route' => ['defence.store', $attack], 'autocomplete'=>'off']) !!}
		
		@include('partials.defence_form', ['attack',$attack])

		<div class="form-group">		
			{!! Form::submit('Save',['class'=>'btn btn-primary'])!!}
			<a href="{{route('tree.show',[$attack->tree->id])}}" class="btn btn-danger">Back</a>
		</div>

	    {!! Form::close() !!}

	</div>
</div>


@endsection