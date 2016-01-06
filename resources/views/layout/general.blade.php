@extends('layout.master')

@section('body_class')
site-menubar-unfold site-menubar-keep
@endsection

@section('page')

	@include('layout.header')

	@include('layout.menu')                

	<div class="page animsition">
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
		<div class="page-content">

			<div class="panel">
        		<div class="panel-body container-fluid">

					@yield('content')

				</div>
			</div>
		</div>
	</div>

	@include('layout.footer')

@endsection