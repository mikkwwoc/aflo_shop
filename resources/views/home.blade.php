@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Jesteś zalogowany') }}
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">| SKLEP INTERNETOWY - AFlo shop |</p></div>
</footer>
@endsection
