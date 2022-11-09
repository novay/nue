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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

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

    <div class="modal fade" id="dialog-ajax" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
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

    <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.pjax.defaults.timeout = 5000;
            $.pjax.defaults.maxCacheLength = 0;
            $(document).ready(function() {
                $(document).pjax('[data-pjax] a, a[data-pjax]', {
                    container: '#pjax-container'
                });
                $.pjax.reload('#pjax-container')
            });

            $(document).on('pjax:send', function() {
                NProgress.start();
            });
            $(document).on('pjax:complete', function() {
                NProgress.done();
            });

            $(document).on('pjax:timeout', function (event) {
                event.preventDefault();
            })

            $(document).on('submit', 'form[form-pjax]', function (event) {
                $.pjax.submit(event, '#pjax-container')
            });

            $(document).on("pjax:popstate", function () {
                $(document).one("pjax:end", function (event) {
                    $(event.target).find("script[data-exec-on-popstate]").each(function () {
                        $.globalEval(this.text || this.textContent || this.innerHTML || '');
                    });
                });
            });

            $(document).on('pjax:send', function (xhr) {
                if (xhr.relatedTarget && xhr.relatedTarget.tagName && xhr.relatedTarget.tagName.toLowerCase() === 'form') {
                    $submit_btn = $('form[form-pjax] :submit');
                    if ($submit_btn) {
                        $submit_btn.button('loading')
                    }
                }
                NProgress.start();
            });

            $(document).on('pjax:complete', function (xhr) {
                if (xhr.relatedTarget && xhr.relatedTarget.tagName && xhr.relatedTarget.tagName.toLowerCase() === 'form') {
                    $submit_btn = $('form[form-pjax] :submit');
                    if ($submit_btn) {
                        $submit_btn.button('reset')
                    }
                }
                NProgress.done();
            });

            (function() {
                $('.js-navbar-vertical-aside a.nav-link:not(.dropdown-toggle)').on('click', function () {
                    var $parent = $(this).addClass('active');
                    $parent.parent().siblings('.nav-link.active').trigger('click');
                    $parent.parent().siblings().removeClass('active').find('a.nav-link').removeClass('active');
                });
                window.onload = function () {
                    new NueSideNav('.js-navbar-vertical-aside').init();
                    NueDropdown.init();
                    new NueFileAttach('.js-file-attach');
                    new NueTogglePassword('.js-toggle-password');
                }
                const $dropdownBtn = document.getElementById('theme-dropdown');
                const $variants = document.querySelectorAll(`[aria-labelledby="theme-dropdown"] [data-icon]`);
                const setActiveStyle = function () {
                    $variants.forEach($item => {
                        if ($item.getAttribute('data-value') === NueThemeAppearance.getOriginalAppearance()) {
                            $dropdownBtn.innerHTML = `<i class="${$item.getAttribute('data-icon')}" />`;
                            return $item.classList.add('active');
                        }
                        $item.classList.remove('active');
                    });
                };
                $variants.forEach(function ($item) {
                    $item.addEventListener('click', function () {
                        NueThemeAppearance.setAppearance($item.getAttribute('data-value'));
                    })
                });
                setActiveStyle();
                window.addEventListener('on-nue-appearance-change', function () {
                    setActiveStyle();
                });
                
                @auth
                    $(document).on('click', '#dialog-button', function(event) {
                        event.preventDefault();
                        let href = $(this).attr('data-href');
                        $.ajax({
                            url: href,
                            beforeSend: function() {
                                NProgress.start();
                            },
                            success: function(result) {
                                $('#dialog-ajax').modal("show");
                                $('#dialog-body').html(result).show();
                            },
                            complete: function() {
                                NProgress.done();
                            },
                            error: function(jqXHR, testStatus, error) {
                                Swal.fire({
                                    title: 'Galat!',
                                    icon: 'error',
                                    html: "Page " + href + " cannot open. Error:" + error
                                }).then((value) => {
                                    $('#dialog-ajax').modal('hide');
                                });
                                $('#loader').hide();
                            },
                            timeout: 8000
                        })
                    });
                @endauth
            })();

            (function( w ){
                var loadJS = function( src, cb ){
                    "use strict";
                    var ref = w.document.getElementsByTagName( "script" )[ 0 ];
                    var script = w.document.createElement( "script" );
                    script.src = src;
                    script.async = true;
                    ref.parentNode.insertBefore( script, ref );
                    if (cb && typeof(cb) === "function") {
                        script.onload = cb;
                    }
                    return script;
                };
                if( typeof module !== "undefined" ){
                    module.exports = loadJS;
                }
                else {
                    w.loadJS = loadJS;
                }
            }( typeof global !== "undefined" ? global : this ));
        </script>

    {!! Nue::js() !!}
</body>
</html>
