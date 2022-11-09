<style>
    .card-body-height.card-system {
        height: calc(100vh - 177px);
    }
</style>

@include('nue::partials.breadcrumb', ['lists' => [
    'Nue Settings' => 'javascript:;', 
    $title => 'active'
]])

@php 
    $check = '<i class="bi bi-check-lg text-success"></i>';
    $times = '<i class="bi bi-x-lg text-danger"></i>';
@endphp
<div class="card rounded-0 border-0 shadow-none bg-transparent">
    <div class="card-body p-0">
        <div class="accordion" id="accordion-example">
            <div class="alert alert-warning mb-0 rounded-0">
                <p class="mb-2">{{ __('Troubleshooting Desc') }}</p>
                <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#report">
                    {{ __('Get System Report') }}
                </button>
            </div>
        </div>
        <div class="row gx-2 card-body-height card-system p-2">
            <div class="col-lg-8">
                <div class="card mb-0 rounded-0 shadow-none border">
                    <div class="card-header bg-light p-3">
                        <h4 class="card-title">
                            {{ __('Installed Package') }}
                        </h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead class="bg-dark">
                                <tr>
                                    <th width="50%" class="text-white">{{ __('Package Name') }} : {{ __('Version') }}</th>
                                    <th class="text-white">{{ __('Dependency Name') }} : {{ __('Version') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($packages as $i => $temp)
                                    <tr>
                                        <td>
                                            {{ $temp['name'] }} :
                                            <span class="badge bg-danger mb-1">{{ $temp['version'] }} :</span>
                                        </td>
                                        <td>
                                            <ul class="mb-0 ps-3">
                                                @foreach($temp['dependencies'] as $ii => $side)
                                                    <li>{{ $ii }} : <span class="badge bg-danger mb-1">{{ $side }} :</span></li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-2 rounded-0 shadow-none border">
                    <div class="card-header bg-light p-3">
                        <h4 class="card-title">
                            {{ __('System Environment') }}
                        </h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Application Version: {{ env('APP_VERSION') }}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Framework Version: {{ $system['version'] }}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Timezone: {{ $system['timezone'] }}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Debug Mode: {!! $system['debug_mode'] ? $check : $times !!}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Storage Dir Writable: {!! $system['storage_dir_writable'] ? $check : $times !!}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Cache Dir Writable: {!! $system['cache_dir_writable'] ? $check : $times !!}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            App Size: <b>{{ $system['app_size'] }}</b>
                        </li>
                    </ul>
                </div>

                <div class="card mb-2 rounded-0 shadow-none border">
                    <div class="card-header bg-light p-3">
                        <h4 class="card-title">
                            {{ __('Server Environment') }}
                        </h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            PHP Version: {{ $server['version'] }} 
                            @if($matchPHPRequirement)
                                {!! $check !!}
                            @else
                                {!! $times !!}
                                <span class="text-danger">
                                    (PHP must be >= {{ $requiredPhpVersion }})
                                </span>
                            @endif
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Memory limit: {!! $server['memory_limit'] ?: '&mdash;' !!}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Max execution time (s): {!! $server['max_execution_time'] ?: '&mdash;' !!}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Server Software: {{ $server['server_software'] }}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Server OS: {{ $server['server_os'] }}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Database: {{ $server['database_connection_name'] }}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            SSL Installed:  {!! $server['ssl_installed'] ? $check : $times !!}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Cache Driver: {{ $server['cache_driver'] }}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Session Driver: {{ $server['session_driver'] }}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Queue Connection: {{ $server['queue_connection'] }}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            OpenSSL Ext: {!! $server['openssl'] ? $check : $times !!}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Mbstring Ext: {!! $server['mbstring'] ? $check : $times !!}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            PDO Ext: {!! $server['pdo'] ? $check : $times !!}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            CURL Ext: {!! $server['curl'] ? $check : $times !!}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Exif Ext: {!! $server['exif'] ? $check : $times !!}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            File info Ext: {!! $server['fileinfo'] ? $check : $times !!}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Tokenizer Ext: {!! $server['tokenizer']  ? $check : $times!!}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Imagick/GD Ext: {!! $server['imagick_or_gd']  ? $check : $times!!}
                        </li>
                        <li class="list-group-item list-group-item-action py-2 px-3">
                            Zip Ext: {!! $server['zip']  ? $check : $times!!}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="report-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-1">
            <div class="modal-header p-3">
                <h5 class="modal-title" id="report-label">
                    {{ __('System Report') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div id="report-wrapper">
                    <textarea name="txt-report" id="txt-report" class="form-control rounded-0" rows="10" spellcheck="false" onfocus="this.select()">
### System Environment
- Application Version: {{ env('APP_VERSION') }}
- Framework Version: {{ $system['version'] }}
- Timezone: {{ $system['timezone'] }}
- Debug Mode: {!! $system['debug_mode'] ? '&#10004;' : '&#10008;' !!}
- Storage Dir Writable: {!! $system['storage_dir_writable'] ? '&#10004;' : '&#10008;' !!}
- Cache Dir Writable: {!! $system['cache_dir_writable'] ? '&#10004;' : '&#10008;' !!}
- App Size: {{ $system['app_size'] }}

### Server Environment
- PHP Version: {{ $server['version'] . (!$matchPHPRequirement ? '(' . trans('core/base::system.php_version_error', ['version' => $requiredPhpVersion]) . ')' : '') }}
- Memory limit: {!! $server['memory_limit'] ?: '&mdash;' !!}
- Max execution time (s): {!! $server['max_execution_time'] ?: '&mdash;' !!}
- Server Software: {{ $server['server_software'] }}
- Server OS: {{ $server['server_os'] }}
- Database: {{ $server['database_connection_name'] }}
- SSL Installed: {!! $server['ssl_installed'] ? '&#10004;' : '&#10008;' !!}
- Cache Driver: {{ $server['cache_driver'] }}
- Queue Connection: {{ $server['queue_connection'] }}
- Session Driver: {{ $server['session_driver'] }}
- Mbstring Ext: {!! $server['mbstring'] ? '&#10004;' : '&#10008;' !!}
- OpenSSL Ext: {!! $server['openssl'] ? '&#10004;' : '&#10008;' !!}
- PDO Ext: {!! $server['pdo'] ? '&#10004;' : '&#10008;' !!}
- CURL Ext: {!! $server['curl'] ? '&#10004;' : '&#10008;' !!}
- Exif Ext: {!! $server['exif'] ? '&#10004;' : '&#10008;' !!}
- File info Ext: {!! $server['fileinfo'] ? '&#10004;' : '&#10008;' !!}
- Tokenizer Ext: {!! $server['tokenizer']  ? '&#10004;' : '&#10008;'!!}
- Imagick/GD Ext: {!! $server['imagick_or_gd']  ? '&#10004;' : '&#10008;'!!}
- Zip Ext: {!! $server['zip']  ? '&#10004;' : '&#10008;'!!}

### Installed packages and their version numbers
@foreach($packages as $package)
- {{ $package['name'] }} : {{ $package['version'] }}
@endforeach
                    </textarea>
                </div>
            </div>
            <div class="modal-footer border-0 p-2">
                <button id="copy-report" class="btn btn-info btn-sm ms-1 mt-1 mb-1">
                    {{ __('Copy Report') }}
                </button>
            </div>
        </div>
    </div>
</div>