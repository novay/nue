@if(Session::has('notify'))
    @php
        $notify     = Session::pull('notify');
        $type       = \Illuminate\Support\Arr::get($notify->get('type'), 0, 'success');
        $message    = \Illuminate\Support\Arr::get($notify->get('message'), 0, '');
        $options    = json_encode($notify->get('options', []));
    @endphp
    <script>
        $(function () {
            toastr.{{$type}}('{!! $message !!}', null, {!! $options !!});
        });
    </script>
@endif