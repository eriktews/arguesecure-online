@extends('layout.master')

@section('body_class')
instructions-page layout-full
@endsection

@section('title','Change superuser password')

@section('page')

<div class="page animsition vertical-align text-center">

    <div class="page-content vertical-align-middle">
        <div class="panel panel-bordered">
            <div class="panel-body">

                <div class="brand">
                    <h2 class="brand-text font-size-18">Argue Secure</h2>
                </div>

				<h5>Change superuser password</h5>

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

				<form id="change_admin_password" action="{{route('superuser.setadminpassword')}}" method="POST" autocomplete="off">
					{!! csrf_field() !!}
			       <div class="form-group form-material">
			           <label class="control-label" for="current_password">Current Password:</label>
			           {!! Form::password('current_password', ['class'=>'form-control', 'id'=>"current_password"]) !!}
			       </div> 
			        <div class="form-group form-material">
			            <label class="control-label" for="new_password">New Password:</label>
			            {!! Form::password('new_password', ['class'=>'form-control', 'id'=>"new_password"]) !!}
			        </div>
			        <div class="form-group form-material">
			            <label class="control-label" for="confirm_password">Confirm Password:</label>
			            {!! Form::password('confirm_password', ['class'=>'form-control', 'id'=>"confirm_password"]) !!}
			        </div>
			        <div class="form-group">        
			            {!! Form::submit('Change password',['class'=>'btn btn-primary'])!!}
			        </div>
				</form>
                
            </div>
        </div>
        
    </div>

</div>

@endsection