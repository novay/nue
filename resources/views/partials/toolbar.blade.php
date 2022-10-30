<div class="d-flex justify-content-between">
    @isset($datatable)
        <style>
            #datatable_filter {
                display: none;
            }
            .dataTables_scrollBody thead tr:first-child {
                height: 0px;
                border-width: 0;
            }
        </style>
        <div class="w-100">
            <div class="input-group input-group-merge input-group-borderless input-group-hover-light navbar-input-group rounded-0">
                <div class="input-group-prepend input-group-text px-2">
                    <i class="bi-search"></i>
                </div>
                <input id="datatabe-search" type="search" class="form-control rounded-0 ps-5" placeholder="{{ __('Search') }}" aria-label="{{ __('Search') }}" autocomplete="off">
            </div>
        </div>
    @endisset
    <div class="toolbar d-flex">
        @isset($back)
            <a class="btn btn-secondary d-inline-flex align-items-center fw-medium border-0 rounded-0" href="{{ $back }}">
                <i class="bi bi-chevron-left me-1"></i>
                {{ __('Back') }}
            </a>
        @endisset
        @isset($datatable)
            <div id="datatable-checkbox-info" style="display: none;">
                <button type="button" class="btn btn-danger d-inline-flex align-items-center fw-medium border-0 rounded-0" id="delete-selected">
                    <i class="bi bi-trash me-1"></i>
                    {{ __('Delete') }} <span id="datatable-checkbox" class="mx-1">0</span> {{ __('rows') }}
                </button>
            </div>
        @endisset
        @isset($create)
            <a class="btn btn-success d-inline-flex align-items-center fw-medium border-0 rounded-0" href="{{ $create }}" data-pjax>
                <i class="bi bi-plus-lg me-1"></i>
                {{ __('Create') }}
            </a>
        @endisset
    </div>
</div>