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
					<li>Create user</li>
                    <li>Print PDF from CSV</li>
				</ul>
                
            </div>
        </div>
        
    </div>

</div>

@endsection