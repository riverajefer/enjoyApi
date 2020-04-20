@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <example-component></example-component> --}}
    {{-- <nav-bar-component title="{{ config('app.name', 'Laravel') }}" name="{{ Auth::user()->name }}"></nav-bar-component> --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                    <btn-validate-component></btn-validate-component>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
