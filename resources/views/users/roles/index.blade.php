@extends('layouts.base')
@section('title', $title)

@section('js')
    <script src="https://aws.btekno.id/templates/front-dashboard/2.1/vendor/datatables/media/js/jquery.dataTables.min.js"></script>
    <script>
        var table = Nue.components.NueDatatables.init('.js-datatable', {
            bSort: false, 
            paging: false,
            searching: false, 
            bInfo: false, 
            scrollY: 'calc(100vh - 200px)',
            ajax : '{!! request()->fullUrl() !!}?datatable=true', 
            columns: [
                { data: 'pilihan', name: 'pilihan', className: 'pe-0 bg-light text-center', orderable: false, searchable: false },
                { data: 'id', name: 'id', className: 'text-center' },
                { data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false }, 
                { data: 'name', name: 'name' },
                { data: 'slug', name: 'slug' },
                { data: 'permission', name: 'permission', orderable: false, searchable: false },
            ],
            @include('nue::partials.datatable.script')
        });
    </script>
@endsection

@section('content')

    {!! Form::open(['method' => 'DELETE', 'route' => ["$prefix.destroy", 'hapus-all'], 'id' => 'submit-all']) !!}

        @include('nue::partials.breadcrumb', ['lists' => [
            __('User Management') => 'javascript:;', 
            $title => 'active'
        ]])

        @include('nue::partials.toolbar', [
            'create' => route("$prefix.create"), 
            'datatable' => true
        ])

    	<div class="card border-0 shadow-none rounded-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="datatable" class="js-datatable table table-sm table-hover table-bordered table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th class="pe-0" width="1">
                                    <div class="form-check mb-0">
                                        <input id="datatable-checkbox-check" type="checkbox" class="form-check-input">
                                        <label class="form-check-label" for="check-all"></label>
                                    </div>
                                </th>
                                <th width="1">ID</th>
                                <th width="1"></th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Slug') }}</th>
                                <th>{{ __('Permission') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            @include('nue::partials.datatable.footer')
        </div>

    {!! Form::close() !!}

@endsection