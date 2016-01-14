@extends('layout.general')

@section('body_class')
@parent
attacks-create-page
@endsection

@section('title','Create Attack')

@section('content')

<div class="panel">
	
	<div class="panel-body container-fluid">

		{!! Form::model($attack = new \App\Attack(), ['route' => ['attack.store', $risk], 'autocomplete'=>'off']) !!}
		
		@include('partials.attack_form')

		<div class="form-group">		
			{!! Form::submit('Save',['class'=>'btn btn-primary'])!!}
			<a href="{{route('tree.show',[$risk->tree->id])}}" class="btn btn-danger">Back</a>
		</div>

	    {!! Form::close() !!}

	</div>
</div>


@endsection