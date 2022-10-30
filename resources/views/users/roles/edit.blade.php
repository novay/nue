@extends('layouts.base')
@section('title', __('Edit')." :: $title")

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-duallistbox@3.0.9/dist/bootstrap-duallistbox.min.css">
    <style>
        .bootstrap-duallistbox-container select {
            padding: 10px;
            border-radius: 0;
        }
    </style>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-duallistbox@3.0.9/dist/jquery.bootstrap-duallistbox.min.js"></script>
    <script>
        $(document).ready(function() {
            var listbox = $('select[name="permissions[]"]').bootstrapDualListbox();

            $('input.filter').addClass('rounded-0');
            $('.btn.moveall i').removeClass().addClass('bi bi-arrow-right');
            $('.removeall i').removeClass().addClass('bi bi-arrow-left');
            $('.move i').removeClass().addClass('bi bi-arrow-right');
            $('.remove i').removeClass().addClass('bi bi-arrow-left');
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