@extends('layout.master')

@section('body_class')
site-menubar-unfold site-menubar-keep
@endsection

@section('page')

	@include('layout.header')

	@include('layout.menu')                

	<div class="page animsition">
		@if(Session::has('success'))
		<div id="site-messages" class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            	<span aria-hidden="true">×</span>
        	    <span class="sr-only">Close</span>
            </button>
            <p>{{Session::get('success')}}</p>
        </div>
		@endif
        @if($errors->any())
		<div id="site-alerts" class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            	<span aria-hidden="true">×</span>
        	    <span class="sr-only">Close</span>
            </button>
            @foreach($errors->all() as $error)
            <p>{{$error}}</p>
            @endforeach
        </div>
        @endif
		<div class="page-header">
			<h1 class="page-title">@yield('title')</h1>
		</div>
		<div class="page-content container-fluid">

			@yield('content')
			
		</div>
	</div>

	@include('layout.footer')

@endsection