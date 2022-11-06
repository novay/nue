@extends('layouts.base')
@section('title', $title)

@section('js')
    <script src="https://aws.btekno.id/templates/front-dashboard/2.1/vendor/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="https://aws.btekno.id/templates/front-dashboard/2.1/vendor/datatables.net.extensions/select/select.min.js"></script>
    <script>
        Nue.components.NueDatatables.init('.js-datatable', {
            scrollY: 'calc(100vh - 200px)',
            ajax : '{!! request()->fullUrl() !!}?datatable=true', 
            columns: [
                { data: 'pilihan', name: 'pilihan', className: 'text-center', orderable: false, searchable: false },
                { data: 'id', name: 'id', className: 'text-center' },
                { data: 'user', name: 'user.name' },
                { data: 'method', name: 'method' },
                { data: 'path', name: 'path' },
                { data: 'ip', name: 'ip', orderable: false, searchable: false },
                { data: 'input', name: 'input', className: 'small', orderable: false, searchable: false },
                { data: 'created_at', name: 'created_at', className: 'text-end', orderable: false, searchable: false }
            ],
            @include('nue::partials.datatable.script')
        });
    </script>
@endsection

@section('content')

    {!! Form::open(['method' => 'DELETE', 'route' => ["$prefix.destroy", 'hapus-all'], 'id' => 'submit-all']) !!}

        @include('nue::partials.breadcrumb', ['lists' => [
            'Nue Settings' => 'javascript:;', 
            $title => 'active'
        ]])

        @include('nue::partials.toolbar', [
            'datatable' => true
        ])

    	<div class="card border-0 shadow-none rounded-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="datatable" class="js-datatable table table-sm table-hover table-bordered table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th class="table-column-pr-0" width="1">
                                    <div class="form-check mb-0">
                                        <input id="datatable-checkbox-check" type="checkbox" class="form-check-input">
                                        <label class="form-check-label" for="check-all"></label>
                                    </div>
                                </th>
                                <th width="1">ID</th>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Method') }}</th>
                                <th>{{ __('Path') }}</th>
                                <th>{{ __('IP') }}</th>
                                <th>{{ __('Input') }}</th>
                                <th>{{ __('Created At') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            @include('nue::partials.datatable.footer')
        </div>

    {!! Form::close() !!}

@endsection