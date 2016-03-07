@extends('layout.general')

@section('body_class')
@parent
risks-create-page
@endsection

@section('title','Create Risk')

@section('content')

<div class="panel">
	
	<div class="panel-body container-fluid">

		{!! Form::model($risk = new \App\Risk(), ['route' => ['risk.store', $tree], 'autocomplete'=>'off']) !!}
		
		@include('partials.risk_form')

		<div class="form-group">		
			{!! Form::submit('Save',['class'=>'btn btn-primary'])!!}
			<a href="{{route('tree.show',[$tree->id])}}" class="btn btn-danger">Back</a>
		</div>

	    {!! Form::close() !!}

	</div>
</div>


@endsection