@include('templates.config')
@extends('templates.default')

@section('content')

{!! Charts::styles() !!}

<!-- Main Application (Can be VueJS or other JS framework) -->
<div class="app">
    <center>
        {!! $chart->html() !!}
    </center>
</div>
<!-- End Of Main Application -->
{!! Charts::scripts() !!}
{!! $chart->script() !!}


@stop