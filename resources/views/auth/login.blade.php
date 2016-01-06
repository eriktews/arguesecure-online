@extends('layout.master')

@section('body_class')
login-page layout-full
@endsection

@section('page')

<div class="page animsition vertical-align text-center">

    <div class="page-content vertical-align-middle">
        <div class="panel">
            <div class="panel-body">

                <div class="brand">
                    <h2 class="brand-text font-size-18">Argue Secure</h2>
                </div>

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                    @endforeach
                </div>
                @endif

                <form method="POST" action="{{ url('auth/login') }}">
                    {!! csrf_field() !!}
                    <div class="form-group form-material floating">
                        <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                        <label class="floating-label">Email</label>
                    </div>
                    <div class="form-group form-material floating">
                        <input id="password" class="form-control" type="password" name="password" value="{{ old('email') }}">
                        <label class="floating-label">Password</label>
                    </div>
                    <div class="form-group clearfix">
                        <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg pull-left">
                            <input id="rememberMeCheckbox" name="remember" type="checkbox">
                            <label for="rememberMeCheckbox">Remember me</label>
                        </div>
                        {{-- <a class="pull-right" href="forgot-password.html">Forgot password?</a> --}}
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg margin-top-40">Sign in</button>
                  </form>   
            </div>
        </div>
        
    </div>

</div>

@endsection