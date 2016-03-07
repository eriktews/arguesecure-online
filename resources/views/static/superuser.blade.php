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
                    <h2 class="brand-text font-size-18">Argue Secure - SuperUser Page</h2>
                </div>

				<h5>Actions</h5>

				<ul>
					<li><a href="{{route('superuser.useradmin')}}">View user list</a></li>
                    <li><a href="{{route('superuser.csvuser')}}">Add users from CSV</a></li>
                    <li><a href="{{route('superuser.pdfsheet')}}">Print PDF from CSV</a></li>
				</ul>
                
            </div>
        </div>
        
    </div>

</div>

@endsection