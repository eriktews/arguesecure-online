@extends('layout.master')

@section('body_class')
error-page layout-full
@endsection

@section('title','Not Authorized')

@section('page')

<div class="page animsition vertical-align text-center">

    <div class="page-content vertical-align-middle">
        <div class="panel panel-bordered">
            <div class="panel-body">

                <div class="brand">
                    <h2 class="brand-text font-size-18">Argue Secure</h2>
                </div>

                <p>You do not have the authorization to see this page</p>
            </div>
        </div>
    </div>
</div>


@endsection
