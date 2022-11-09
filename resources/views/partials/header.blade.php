<header id="header" class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered bg-white pe-3">
    <div class="navbar-nav-wrap">
        <a class="navbar-brand" href="/" aria-label="Nue">
            <img class="navbar-brand-logo" src="{{ config('nue.brand.logo.default.light') }}" alt="Logo" data-nue-theme-appearance="default">
            <img class="navbar-brand-logo" src="{{ config('nue.brand.logo.default.dark') }}" alt="Logo" data-nue-theme-appearance="dark">
            <img class="navbar-brand-logo-mini" src="{{ config('nue.brand.logo.mini.light') }}" alt="Logo" data-nue-theme-appearance="default">
            <img class="navbar-brand-logo-mini" src="{{ config('nue.brand.logo.mini.dark') }}" alt="Logo" data-nue-theme-appearance="dark">
        </a>
        <div class="navbar-nav-wrap-content-start toolbar w-100">
            <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
            </button>
            @auth
                <div class="navbar-nav-wrap-content-end">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="navbar-dropdown-account-wrapper bg-light border pe-3" href="javascript:;" data-href="{{ route('profile.show') }}?page=overview&time={{ time() }}" id="dialog-button" data-size="modal-lg">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm avatar-circle">
                                        <img class="avatar-img" src="{{ me()->photo_url }}" alt="">
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h5 class="mb-0">{{ me()->name }}</h5>
                                        <p class="card-text text-body small">{{ me()->email }}</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</header>