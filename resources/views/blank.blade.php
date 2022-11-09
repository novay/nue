<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') :: {{ config('nue.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ config('nue.brand.favicon') }}">

    <link rel="stylesheet" href="{{ config('nue.brand.cdn') }}/vendor/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preload" href="{{ config('nue.brand.cdn') }}/css/theme.min.css" data-nue-appearance="default" as="style">
    <link rel="preload" href="{{ config('nue.brand.cdn') }}/css/theme-dark.min.css" data-nue-appearance="dark" as="style">
    <style data-nue-appearance-onload-styles>* { transition: unset !important }body { opacity: 0 }</style>
    <script>window.nue_config = {"themeAppearance":{"layoutSkin":"default"}}</script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('css')
</head>
<body>
    <script src="{{ config('nue.brand.cdn') }}/js/nue-theme-appearance.js"></script>
    @yield('content')
    <script src="{{ config('nue.brand.cdn') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ config('nue.brand.cdn') }}/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
    <script src="{{ config('nue.brand.cdn') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ config('nue.brand.cdn') }}/js/theme.min.js"></script>
    <script>
        (function() {
            window.onload = function () {
                NueDropdown.init();
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
            }
        })();
    </script>
    @yield('js')
</body>
</html>