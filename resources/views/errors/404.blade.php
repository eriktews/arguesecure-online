@extends('layout.master')

@section('body_class')
error-page layout-full
@endsection

@section('title','Error')

@section('page')

<div class="page animsition vertical-align text-center">

    <div class="page-content vertical-align-middle">
        <div class="panel panel-bordered">
            <div class="panel-body">

                <div class="brand">
                    <h2 class="brand-text font-size-18">Argue Secure</h2>
                </div>

                <p>The item you requested was not found :(</p>
            </div>
        </div>
    </div>
</div>


@endsection
