@extends('layout.master')

@section('body_class')
useradmin-page layout-full
@endsection

@section('title','Instructions')

@section('page')

<div class="page animsition vertical-align text-center">

    <div class="page-content vertical-align-middle">
        <div class="panel panel-bordered">
            <div class="panel-body">

                <div class="brand">
                    <h2 class="brand-text font-size-18">Argue Secure - SuperUser Page - View User List</h2>
                </div>

                {!! Form::model($user = new \App\User(), ['route' => ['superuser.useradmin.create'], 'method'=>'post', 'autocomplete'=>'off']) !!}
                <div class="row">
                    <div class="col-md-3">
                       <div class="form-group form-material">
                           <label class="control-label" for="name">Name</label>
                           {!! Form::text('name', null, ['class'=>'form-control', 'id'=>"name"]) !!}
                       </div> 
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-material">
                            <label class="control-label" for="email">Email</label>
                            {!! Form::text('email', null, ['class'=>'form-control', 'id'=>"email"]) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-material">
                            <label class="control-label" for="password">Password</label>
                            {!! Form::text('password', null, ['class'=>'form-control', 'id'=>"password"]) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">        
                            {!! Form::submit('Create',['class'=>'btn btn-primary'])!!}
                        </div>
                    </div>
                </div>
                {!! Form::close()!!}

				<table class="table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
                        </tr>
                        @foreach(\App\User::all() as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                {!! Form::model($user, ['route' => ['superuser.useradmin.delete', $user->id], 'method'=>'delete', 'autocomplete'=>'off']) !!}
                                {!! Form::submit('Delete',['class'=>'btn btn-danger'])!!}
                                {!! Form::close()!!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
        
    </div>

</div>

@endsection