{{-- Styles --}}
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.css">
<style>
	.dd {
		max-width: none;
	}
	.dd-handle {
		height: 40px;
		margin: 5px;
		padding: 10px;
		border: 1px solid #eeeff5;
	}
	.dd-list .dd-list {
		padding-left: 25px;
	}
	.swal2-modal .swal2-title {
		font-size: 20px;
	}
	.swal2-modal .swal2-buttonswrapper {
		margin-top: 0;
	}
	.swal2-modal .swal2-styled {
		font-size: 15px;
		font-weight: 500;
		margin: 20px 5px;
		padding: 5px 20px;
	}
</style>

{{-- Script --}}
<script type="text/javascript" src=""></script>
<script data-exec-on-popstate>
	$(document).on('pjax:end', function () {
        loadJS("https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.js", function () {
            $('#nestable-menu').on('click', function(e) {
				var target = $(e.target),
				action = target.data('action');
				if (action === 'expand-all') {
					$('#nestable').nestable('expandAll');
				}
				if (action === 'collapse-all') {
					$('#nestable').nestable('collapseAll');
				}
			});

		    var updateOutput = function(e) {
		        var list = e.length ? e : $(e.target),
		            output = list.data('output');
		        if (window.JSON) {
		            output.val(window.JSON.stringify(list.nestable('serialize')));
		        } else {
		            output.val('JSON browser support required for this demo.');
		        }
		    };

		    $('#nestable').nestable({group: 1}).on('change', updateOutput);
			updateOutput($('#nestable').data('output', $('#nestable-output')));

			$('.menu-delete').click(function() {
				var id = $(this).data('id');
				Swal.fire({
					title: "Are you sure ?",
					icon: "warning",
					text: "We will delete this menu permanently.",
					width: "300px", 
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Confirm",
					cancelButtonText: "Cancel",
					allowOutsideClick: false
				}).then(function(result) {
					if(result.value) {
						$.ajax({
							type: 'DELETE',
							url: '{{ route("$prefix.index") }}' + '/' + id,
							data: {
								"id": id,
								"_token": $('meta[name="csrf-token"]').attr('content'),
							},
							success: function(data) {
								if(data == "success") {
									$.pjax.reload('#pjax-container');
								} else {
									Swal.fire({
										icon: 'warning',
										title: 'Galat!',
										width: "300px", 
										html: 'Terjadi kesalahan saat menghapus data. Coba sekali lagi.'
									});
								}
							}
						});
					}
				});
			});
        });
    });
</script>

{{-- Content --}}
@include('nue::partials.breadcrumb', ['lists' => [
    'Nue Settings' => 'javascript:;', 
    $title => 'active'
]])

<div class="content container-fluid bg-light h-breadcrumb p-2">
	<div class="row gx-2">
		<div class="col-md-7">
			<div class="card shadow-none border rounded-0 mb-3">
				<div class="card-header bg-light p-2">
					{!! Form::open(['route' => "$prefix.store", 'form-pjax']) !!}
                        <div id="nestable-menu" class="btn-group">
							<a class="btn btn-primary btn-sm" data-action="expand-all" title="{{ __('Expand') }}">
								{{ __('Expand') }}
							</a>
							<a class="btn btn-primary btn-sm" data-action="collapse-all" title="{{ __('Collapse') }}">
								{{ __('Collapse') }}
							</a>
						</div>
						<div class="btn-group">
							<a class="btn btn-white btn-sm" title="{{ __('Refresh') }}" href="{{ route("$prefix.index") }}" data-pjax>
								<span class="hidden-xs">{{ __('Refresh') }}</span>
							</a>
							<button type="submit" class="btn btn-info btn-sm" title="{{ __('Save') }}">
								<span class="hidden-xs">{{ __('Save') }}</span>
							</button>
						</div>
                        {!! Form::hidden('order', null, ['id' => 'nestable-output']) !!}
                    {!! Form::close() !!}
				</div>
				<div class="card-body p-2">
					<div class="dd" id="nestable">
						<ol class="dd-list">
							@foreach(config('nue.database.menu_model')::whereParentId(0)->orderBy('order')->get() as $i => $temp)
								<li class="dd-item" data-id="{!! $temp->id !!}">
									<div class="dd-handle d-flex justify-content-between">
										<div>
											@if(!is_null($temp->icon))
												<i class="bi bi-{!! $temp->icon !!} me-1"></i>
											@endif
											{!! __($temp->title) !!}
											<span class="text-muted ms-1">{!! $temp->uri !!}</span>
										</div>
										<div class="dd-nodrag">
											<a href="{!! route("$prefix.edit", $temp->id) !!}" class="text-success me-1" data-pjax>
												<i class="bi bi-pencil-square"></i> 
												{{ __('Edit') }}
											</a>
											<a href="javascript:void(0);" class="menu-delete text-danger" data-id="{!! $temp->id !!}">
												<i class="bi bi-trash-fill"></i>
											</a>
										</div>
									</div>
									@if(config('nue.database.menu_model')::where('parent_id', $temp->id)->count())
										<ol class="dd-list">
                                        	@foreach(config('nue.database.menu_model')::where('parent_id', $temp->id)->orderBy('order', 'asc')->get() as $side)
												<li class="dd-item" data-id="{!! $side->id !!}">
													<div class="dd-handle d-flex justify-content-between">
														<div>
															@if(!is_null($side->icon))
																<i class="bi bi-{!! $side->icon !!} me-1"></i>
															@endif
															{!! __($side->title) !!}
															<span class="text-muted ms-1">{!! $side->uri !!}</span>
														</div>
														<div class="dd-nodrag">
															<a href="{!! route("$prefix.edit", $side->id) !!}" class="text-success me-1" data-pjax>
																<i class="bi bi-pencil-square"></i>
																{{ __('Edit') }}
															</a>
															<a href="javascript:void(0);" class="menu-delete text-danger" data-id="{!! $side->id !!}">
																<i class="bi bi-trash-fill"></i>
															</a>
														</div>
													</div>
												</li>
											@endforeach
										</ol>
									@endif
								</li>
							@endforeach
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			{!! Form::open(['route' => "$prefix.store", 'form-pjax']) !!}
    			<div class="card shadow-none border rounded-0">
    				<div class="card-header bg-light p-3">
    					<h4 class="card-title mb-0">
    						{{ __('New') }}
    					</h4>
    				</div>
					@include("$view.form")
					<div class="card-footer p-3">
						<button type="submit" class="btn btn-sm btn-info">{{ __('Submit') }}</button>
					</div>
				</div>
				{!! Form::hidden('purpose', 'add') !!}
			{!! Form::close() !!}
		</div>
	</div>
</div>