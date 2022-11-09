@if($error = session()->get('error'))
    <div class="alert alert-soft-danger alert-dismissible rounded-0 fade show mb-0" role="alert">
        <h4 class="mb-1 text-danger">
            <i class="bi bi-x-octagon-fill me-1"></i>
            {{ \Illuminate\Support\Arr::get($error->get('title'), 0) }}
        </h4>
        {!!  \Illuminate\Support\Arr::get($error->get('message'), 0) !!}
        <button type="button" class="btn-close small" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif ($errors = session()->get('errors'))
    @if ($errors->hasBag('error'))
        <div class="alert alert-soft-danger alert-dismissible rounded-0 fade show mb-0" role="alert">
            {!! \Illuminate\Support\Arr::get($error->get('message'), 0) !!}
            @foreach($errors->getBag("error")->toArray() as $message)
                <p>{!!  \Illuminate\Support\Arr::get($message, 0) !!}</p>
            @endforeach
            <button type="button" class="btn-close small" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endif

@if($success = session()->get('success'))
    <div class="alert alert-soft-success alert-dismissible rounded-0 fade show mb-0" role="alert">
        <h4 class="mb-1 text-success">
            <i class="bi bi-check-circle"></i>
            {{ \Illuminate\Support\Arr::get($success->get('title'), 0) }}
        </h4>
        {!!  \Illuminate\Support\Arr::get($success->get('message'), 0) !!}
        <button type="button" class="btn-close small" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($info = session()->get('info'))
    <div class="alert alert-soft-info alert-dismissible rounded-0 fade show mb-0" role="alert">
        <h4 class="mb-1 text-info">
            <i class="bi bi-info-circle me-1"></i>
            {{ \Illuminate\Support\Arr::get($info->get('title'), 0) }}
        </h4>
        {!!  \Illuminate\Support\Arr::get($info->get('message'), 0) !!}
        <button type="button" class="btn-close small" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($warning = session()->get('warning'))
    <div class="alert alert-soft-warning alert-dismissible rounded-0 fade show mb-0" role="alert">
        <h4 class="mb-1 text-warning">
            <i class="bi bi-exclamation-triangle-fill me-1"></i>
            {{ \Illuminate\Support\Arr::get($warning->get('title'), 0) }}
        </h4>
        {!!  \Illuminate\Support\Arr::get($warning->get('message'), 0) !!}
        <button type="button" class="btn-close small" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif