@extends('layouts.app')

@section('title','Logout')

@section('content')
<div class="container">
    <div class="mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-success">
                    <div class="card-header text-white bg-success">Logout!!</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logout complete!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
