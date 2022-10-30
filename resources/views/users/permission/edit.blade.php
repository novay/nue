@extends('layouts.base')
@section('title', __('Edit')." :: $title")

@section('css')
    <link rel="stylesheet" href="{{ config('nue.brand.cdn') }}/vendor/tom-select/css/tom-select.bootstrap5.min.css">
@endsection

@section('js')
    <script src="{{ config('nue.brand.cdn') }}/vendor/tom-select/js/tom-select.complete.min.js"></script>
    <script src="{{ config('nue.brand.cdn') }}/js/nue-tom-select.js"></script>
    <script>
        $(document).ready(function() {
            Nue.components.NueTomSelect.init('.js-select');
        });
    </script>
@endsection

@section('content')
    @include('nue::partials.breadcrumb', ['lists' => [
        __('User Management') => 'javascript:;', 
        $title => route("$prefix.index"), 
        __('Edit') => 'active'
    ]])

    @include('nue::partials.toolbar', [
        'back' => route("$prefix.index")
    ])

    {!! Form::model($edit, ['route' => ["$prefix.update", $edit->id], 'method' => 'PUT']) !!}
        <div class="card rounded-0 shadow-none border-0">
            @include("$view.form")
        </div>
    {!! Form::close() !!}
@endsection