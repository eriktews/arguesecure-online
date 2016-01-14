@extends('layout.general')

@section('body_class')
@parent
attacks-edit-page
@endsection

@section('title','Edit Attack')

@section('content')

<div class="panel">
	
	<div class="panel-body container-fluid">

		{!! Form::model($attack, ['route' => ['attack.update',$attack->parent_id, $attack->id], 'method'=>'put', 'autocomplete'=>'off']) !!}
		
		@include('partials.risk_form')

		<div class="form-group">		
			{!! Form::submit('Save',['class'=>'btn btn-primary'])!!}
			<a href="{{route('tree.show',[$attack->tree->id])}}" class="btn btn-danger">Back</a>
		</div>

	    {!! Form::close() !!}

	</div>
</div>


@endsection