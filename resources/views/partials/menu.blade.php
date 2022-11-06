@if(Nue::user()->visible(\Illuminate\Support\Arr::get($item, 'roles', [])) && Nue::user()->can(\Illuminate\Support\Arr::get($item, 'permission')))
    @if(!isset($item['children']))
        <div class="nav-item">
            @if(url()->isValidUrl($item['uri']))
                <a class="nav-link {{ Request::is($item['uri']) ? 'active' : '' }}" href="{{ $item['uri'] }}" target="_blank">
            @else
                <a class="nav-link {{ Request::is($item['uri']) ? 'active' : '' }}" href="{{ nue_url($item['uri']) }}" data-pjax>
            @endif
                @if(!is_null($item['icon']))
                    <i class="bi bi-{{ $item['icon'] }} nav-icon me-n1"></i>
                @endif
                <span class="nav-link-title">
                    @if (Lang::has($titleTranslation = 'nue.menu_titles.' . trim(str_replace(' ', '_', strtolower($item['title'])))))
                        {{ __($titleTranslation) }}
                    @else
                        {{ __($item['title']) }}
                    @endif
                </span>
            </a>
        </div>
    @else
        <span class="dropdown-header mt-2 px-2">
            @if (Lang::has($titleTranslation = 'nue.menu_titles.' . trim(str_replace(' ', '_', strtolower($item['title'])))))
                {{ __($titleTranslation) }}
            @else
                {{ __($item['title']) }}
            @endif
        </span>
        <small class="bi-three-dots nav-subtitle-replacer"></small>
        @foreach($item['children'] as $item)
            @include('nue::partials.menu', $item)
        @endforeach
    @endif
@endif