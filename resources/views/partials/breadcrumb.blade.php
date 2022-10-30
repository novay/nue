@isset($lists)
	<nav aria-label="breadcrumb" class="py-1 px-2 border-bottom small">
		<ol class="breadcrumb breadcrumb-no-gutter mb-0">
			@foreach($lists as $label => $link)
				@if($loop->last)
					<li class="breadcrumb-item active" aria-current="page">{{ __($label) }}</li>
				@else
					<li class="breadcrumb-item">
						<a class="breadcrumb-link" href="{{ $link }}">{!! __($label) !!}</a>
					</li>
				@endif
			@endforeach
		</ol>
	</nav>
@endisset