@if(Session::has('notify'))
    @php
        $notify = Session::pull('notify');
        if ($notify instanceof \Illuminate\Contracts\Support\MessageBag) {
            $type    = \Illuminate\Support\Arr::get($notify->get('type'), 0, 'success');
            $message = \Illuminate\Support\Arr::get($notify->get('message'), 0, '');
            $options = json_encode($notify->get('options', []));
        } elseif (is_array($notify)) {
            $type = \Illuminate\Support\Arr::get($notify, 'type', 'success');
            if (is_array($type)) {
                $type = reset($type) ?: 'success';
            }
            $message = \Illuminate\Support\Arr::get($notify, 'message', '');
            if (is_array($message)) {
                $message = reset($message) ?: '';
            }
            $options = json_encode(\Illuminate\Support\Arr::get($notify, 'options', []));
        } else {
            $type    = 'success';
            $message = (string) $notify;
            $options = json_encode([]);
        }
    @endphp
    <script>
        $(function () {
            toastr.{{$type}}('{!! $message !!}', null, {!! $options !!});
        });
    </script>
@endif
