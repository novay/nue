@extends('nue::app', ['header' => strip_tags($header)])

@section('content')

    @include('nue::partials.alerts')
    @include('nue::partials.notify')

    @if($_view_)
        @include($_view_['view'], $_view_['data'])
    @else
        {!! $_content_ !!}
    @endif
@endsection
