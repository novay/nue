<script>
	Nue.components.NueTomSelect.init('.js-select');
</script>

@isset($edit)
	<div class="card-body bg-light border-top rounded-0 pb-10" style="min-height:calc(100vh - 130px)">
@else
	<div class="card-body rounded-0">
@endisset
	<div class="row mb-1">
		<label class="col-sm-3 col-form-label" for="parent_id">
			{{ __('Parent') }}
		</label>
		<div class="col-sm-9">
			<div class="tom-select-custom tom-select-custom-with-tags">
				<select class="js-select form-select" autocomplete="off" name="parent_id" 
					data-nue-tom-select-options='{
						"hideSearch": true
					}'>
					@foreach($options as $i => $temp)
						<option value="{{ $i }}"
							@isset($edit)
								{{ $i == $edit->parent_id ? 'selected' : '' }}
							@endisset
						>
							{{ $temp }}
						</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>

	<div class="row mb-1">
		<label class="col-sm-3 col-form-label" for="title">
			{{ __('Title') }} <span class="text-danger">*</span>
		</label>
		<div class="col-sm-9">
			{!! Form::text('title', null, ['class' => 'form-control form-control-sm rounded-0' . $errors->first('title', ' is-invalid')]) !!}
			{!! $errors->first('title', ' <span class="invalid-feedback">:message</span>') !!}
		</div>
	</div>

	<div class="row mb-1">
		<label class="col-sm-3 col-form-label" for="icon">
			{{ __('Icon') }}
		</label>
		<div class="col-sm-9">
			{!! Form::text('icon', null, ['class' => 'form-control form-control-sm rounded-0', 'placeholder' => 'eg. person']) !!}
			<span class="small">
				<small>
					<i class="bi bi-info-circle"></i>
					{{ __('Get Icons') }} <a href="https://icons.getbootstrap.com" target="_blank">https://icons.getbootstrap.com</a>
				</small>
			</span>
		</div>
	</div>

	<div class="row mb-1">
		<label class="col-sm-3 col-form-label" for="uri">
			{{ __('URI') }}
		</label>
		<div class="col-sm-9">
			<div class="input-group input-group-sm">
				<span class="input-group-text bg-light rounded-0">{{ env('APP_URL') }}/</span>
				{!! Form::text('uri', null, ['class' => 'form-control rounded-0', 'autocomplete' => 'off']) !!}
			</div>
		</div>
	</div>

	<div class="row mb-1">
		<label class="col-sm-3 col-form-label" for="roles[]">
			{{ __('Roles') }}
		</label>
		<div class="col-sm-9">
			<div class="tom-select-custom">
				<select class="js-select form-select" autocomplete="off" multiple name="roles[]" 
					data-nue-tom-select-options='{
						"hideSearch": true,
						"placeholder": "{{ __('Select roles') }} ..."
					}'>
					@foreach(config('nue.database.roles_model')::pluck('name', 'id') as $i => $temp)
						<option value="{{ $i }}"
							@isset($edit)
								{{ in_array($i, $edit->roles()->pluck('id')->toArray()) ? 'selected' : '' }}
							@endisset
						>
							{{ $temp }}
						</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>

	<div class="row mb-1">
		<label class="col-sm-3 col-form-label" for="permission">
			{{ __('Permission') }}
		</label>
		<div class="col-sm-9">
			<div class="tom-select-custom">
				<select class="js-select form-select" autocomplete="off" name="permission" 
					data-nue-tom-select-options='{
						"hideSearch": true,
						"placeholder": "{{ __('Select permission') }} ..."
					}'>
					@foreach(config('nue.database.permissions_model')::pluck('name', 'slug') as $i => $temp)
						<option value="{{ $i }}"
							@isset($edit)
								{{ $i == $edit->permission ? 'selected' : '' }}
							@endisset
						>
							{{ $temp }}
						</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>

	@isset($edit)
		<div class="mb-5">&nbsp;</div>
	@endisset
</div>

@isset($edit)
	<div class="position-fixed start-50 bottom-0 translate-middle-x w-100 zi-99 mb-3" style="max-width: 40rem;">
		<div class="card card-sm bg-dark border-dark mx-2">
			<div class="card-body">
				<div class="row justify-content-center justify-content-sm-between">
					<div class="col"></div>
					<div class="col-auto">
						<div class="d-flex gap-3">
							<button type="reset" class="btn btn-ghost-light">{{ __('Reset') }}</button>
							<button type="submit" class="btn btn-primary">
								{{ __('Save') }}
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endisset