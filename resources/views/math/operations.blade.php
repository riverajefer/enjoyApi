@extends('layouts.app')

@section('content')
<div class="container">


    <h1>Operaciones</h1>

    <p>
        {{ $opt_random }}

    </p>
    <drag-opt-component operations="{{ $opt_random }}"></drag-opt-component>



</div>
@endsection
