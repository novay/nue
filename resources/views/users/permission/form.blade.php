<div class="card-body bg-light pb-10" style="min-height: calc(100vh - 130px);">
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
    <div class="mb-10">&nbsp;</div>
</div>

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