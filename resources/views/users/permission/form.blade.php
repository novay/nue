<script>
    $(document).on('pjax:end', function () {
        Nue.components.NueTomSelect.init('.js-select');
    });
</script>
<div class="card-body">
    <div class="row mb-1">
        <label class="col-sm-2 col-form-label" for="name">
            {{ __('Name') }} <span class="text-danger">*</span>
        </label>
        <div class="col-sm-9">
            {!! Form::text('name', null, ['class' => 'form-control form-control-sm rounded-0' . $errors->first('name', ' is-invalid'), 'placeholder' => 'eg. Administrator']) !!}
            {!! $errors->first('name', ' <span class="invalid-feedback">:message</span>') !!}
        </div>
    </div>
    <div class="row mb-1">
        <label class="col-sm-2 col-form-label" for="slug">
            {{ __('Slug') }} <span class="text-danger">*</span>
        </label>
        <div class="col-sm-9">
            {!! Form::text('slug', null, ['class' => 'form-control form-control-sm rounded-0' . $errors->first('slug', ' is-invalid'), 'placeholder' => 'eg. nue.administrator']) !!}
            {!! $errors->first('slug', ' <span class="invalid-feedback">:message</span>') !!}
        </div>
    </div>
    <div class="row mb-1">
        <label class="col-sm-2 col-form-label" for="http_method[]">
            {{ __('HTTP method') }}
        </label>
        <div class="col-sm-9">
            <div class="tom-select-custom tom-select-custom-with-tags mb-1">
                <select class="js-select form-select form-style" name="http_method[]" autocomplete="off" multiple
                    data-nue-tom-select-options='{
                        "placeholder": "{{ __('HTTP method') }}",
                        "hideSearch": true
                    }'>
                    <option value="">{{ __('HTTP method') }}</option>
                    @foreach($options as $temp)
                        <option value="{{ $temp }}"
                            @isset($edit)
                                @if($edit->http_method)
                                    {{ in_array($temp, $edit->http_method) ? 'selected' : '' }}
                                @endif
                            @endisset
                        >{{ $temp }}</option>
                    @endforeach
                </select>
            </div>
            <span class="form-text ms-1">
                <span class="iconify" data-icon="fa:info-circle"></span>
                {{ __('Empty Method') }}
            </span>
        </div>
    </div>
    <div class="row mb-1">
        <label class="col-sm-2 col-form-label" for="http_path">
            {{ __('HTTP path') }}
        </label>
        <div class="col-sm-9">
            {!! Form::textarea('http_path', null, ['class' => 'form-control form-control-sm rounded-0', 'placeholder' => 'eg. /settings/permissions', 'rows' => 3]) !!}
        </div>
    </div>
</div>

<div class="card-footer bg-light border-bottom d-flex p-0">
    <button type="reset" class="btn btn-secondary rounded-0 me-0">{{ __('Reset') }}</button>
    <button type="submit" class="btn btn-success rounded-0">
        <i class="bi bi-save me-1"></i>
        {{ isset($edit) ? __('Save changes') : __('Save') }}
    </button>
</div>