<aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white">
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
            <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                <i class="bi-list navbar-toggler-short-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'></i>
                <i class="bi-list navbar-toggler-full-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'></i>
            </button>
            <a class="navbar-brand d-flex" href="/" aria-label="Nue">
                <img class="navbar-brand-logo" height="50" width="auto" src="{{ config('nue.brand.logo.default.light') }}" alt="Logo" data-nue-theme-appearance="default">
                <img class="navbar-brand-logo" height="50" width="auto" src="{{ config('nue.brand.logo.default.dark') }}" alt="Logo" data-nue-theme-appearance="dark">
            </a>
            <div class="navbar-vertical-content">
                <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
                    @isset($_menu_)
                        @include($_menu_)
                    @else
                        @auth
                            @each('nue::partials.menu', Nue::menu(), 'item')
                        @endauth
                    @endisset
                </div>
            </div>
            <div class="navbar-vertical-footer bg-white">
                <div class="nav nav-pills nav-vertical card-navbar-nav p-0 mb-2">
                    <div class="nav-item">
                        <a class="nav-link" href="javascript:;" data-href="{{ route('profile.show') }}?page=preferences&time={{ time() }}" id="dialog-button" data-size="modal-lg">
                            <i class="bi bi-gear nav-icon me-n2"></i>
                            <span class="nav-link-title">
                                Settings
                            </span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link" href="javascript:;">
                            <i class="bi bi-info-circle nav-icon me-n2"></i>
                            <span class="nav-link-title">
                                Kirim Masukan
                            </span>
                        </a>
                    </div>
                </div>
                <hr class="mt-0 mb-3" />
                <p class="mb-0 text-start small text-muted" style="font-size:70%">
                    {{ date('Y') }} © Enter(wind)<br/>
                    {{ config('nue.name') }} v{{ config('nue.version') }}
                </p>
            </div>
        </div>
    </div>
</aside>
