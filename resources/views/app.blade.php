<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="renderer" content="webkit">
    <title>{!! $header ? "{$header} ::" : '' !!} {{ config('nue.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ config('nue.brand.favicon') }}">

    <link rel="stylesheet" href="{{ config('nue.brand.cdn') }}/vendor/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preload" href="{{ config('nue.brand.cdn') }}/css/theme.min.css" data-nue-appearance="default" as="style">
    <link rel="preload" href="{{ config('nue.brand.cdn') }}/css/theme-dark.min.css" data-nue-appearance="dark" as="style">
    {!! Nue::css() !!}
    <style data-nue-appearance-onload-styles>* { transition: unset !important }body { opacity: 0 }</style>
    <script>window.nue_config = {"themeAppearance":{"layoutSkin":"default"}}</script>
    {!! Nue::headerJs() !!}
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="has-navbar-vertical-aside navbar-vertical-aside-show-xl">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ config('nue.brand.cdn') }}/vendor/tom-select/css/tom-select.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.btekno.id/templates/nue/css/app.css?v2">

    <script src="{{ config('nue.brand.cdn') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ config('nue.brand.cdn') }}/js/nue-theme-appearance.js"></script>
    <script src="{{ config('nue.brand.cdn') }}/vendor/nue-navbar-vertical-aside/nue-navbar-vertical-aside-mini-cache.js"></script>
    <script src="{{ config('nue.brand.cdn') }}/js/theme.min.js"></script>

    @if($alert = config('nue.top_alert'))
        <div class="alert alert-soft-danger text-danger text-center rounded-0 small p-1 border-bottom mb-0">
            {!! $alert !!}
        </div>
    @endif

    @include('nue::partials.header')
    @include('nue::partials.aside')
    <main id="pjax-container" role="main" class="main">
        {!! Nue::style() !!}
        <div id="app">
            @yield('content')
        </div>
        {!! Nue::script() !!}
    </main>
    @include('nue::partials.footer')

    <div class="modal fade" id="dialog-ajax" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div id="dialog-body" class="w-100"></div>
        </div>
    </div>

    <script src="{{ config('nue.brand.cdn') }}/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
    <script src="{{ config('nue.brand.cdn') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ config('nue.brand.cdn') }}/vendor/nue-navbar-vertical-aside/nue-navbar-vertical-aside.min.js"></script>
    <script src="{{ config('nue.brand.cdn') }}/vendor/nue-file-attach/nue-file-attach.min.js"></script>
    <script src="{{ config('nue.brand.cdn') }}/vendor/nue-toggle-password/nue-toggle-password.js"></script>
    <script src="{{ config('nue.brand.cdn') }}/vendor/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="{{ config('nue.brand.cdn') }}/vendor/datatables.net.extensions/select/select.min.js"></script>
    <script src="{{ config('nue.brand.cdn') }}/vendor/tom-select/js/tom-select.complete.min.js"></script>
    <script src="{{ config('nue.brand.cdn') }}/js/nue-tom-select.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.btekno.id/templates/nue/js/app.js"></script>

    {!! Nue::js() !!}
</body>
</html>
