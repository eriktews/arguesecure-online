@extends('layout.master')

@section('body_class')
instructions-page layout-full
@endsection

@section('title','Instructions')

@section('page')

<div class="page animsition vertical-align text-center">

    <div class="page-content vertical-align-middle">
        <div class="panel panel-bordered">
            <div class="panel-body">

                <div class="brand">
                    <h2 class="brand-text font-size-18">Argue Secure</h2>
                </div>

				<h5>Instructions</h5>

				<ul>
					<li>Instruction 1</li>
					<li>Instruction 2</li>
					<li>Instruction 3</li>
					<li>Instruction 4</li>
					<li>Instruction 5</li>
					<li>Instruction 6</li>
					<li>Instruction 7</li>
				</ul>

				@if (Session::get('after_login'))
				<a href="{{route('home')}}">Continue</a>
				@endif
                
            </div>
        </div>
        
    </div>

</div>

@endsection