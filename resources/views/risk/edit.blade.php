@extends('layout.general')

@section('body_class')
@parent
risks-edit-page
@endsection

@section('title','Edit Risk')

@section('content')

<div class="panel">
	
	<div class="panel-body container-fluid">

		{!! Form::model($risk, ['route' => ['risk.update',$risk->parent_id, $risk->id], 'method'=>'put', 'autocomplete'=>'off']) !!}
		
		@include('partials.risk_form')

		<div class="form-group">		
			{!! Form::submit('Save',['class'=>'btn btn-primary'])!!}
			<a href="{{route('tree.show',[$risk->tree->id])}}" class="btn btn-danger">Back</a>
		</div>

	    {!! Form::close() !!}

	</div>
</div>


@endsection