<div class="card-body bg-light pb-10" style="min-height: calc(100vh - 130px);">
    <div class="row mb-1">
        <label class="col-sm-2 col-form-label" for="name">
            {{ __('Name') }} <span class="text-danger">*</span>
        </label>
        <div class="col-sm-9">
            {!! Form::text('name', null, ['class' => 'form-control form-control-sm rounded-0' . $errors->first('name', ' is-invalid')]) !!}
            {!! $errors->first('name', ' <span class="invalid-feedback">:message</span>') !!}
        </div>
    </div>
    <div class="row mb-1">
        <label class="col-sm-2 col-form-label" for="slug">
            {{ __('Slug') }} <span class="text-danger">*</span>
        </label>
        <div class="col-sm-9">
            {!! Form::text('slug', null, ['class' => 'form-control form-control-sm rounded-0' . $errors->first('slug', ' is-invalid')]) !!}
            {!! $errors->first('slug', ' <span class="invalid-feedback">:message</span>') !!}
        </div>
    </div>
    <div class="row mb-2">
        <label class="col-sm-2 col-form-label" for="permissions">
            {{ __('Permission') }}
        </label>
        <div class="col-sm-9">
            <div class="card rounded-0 shadow-none">
                <div class="card-body">
                    <select multiple="multiple" size="10" name="permissions[]" title="permissions[]">
                        @foreach($permissions as $i => $temp)
                            <option value="{{ $i }}"
                                @isset($edit)
                                    {{ in_array($i, $edit->permissions()->pluck('id')->toArray()) ? 'selected' : '' }}
                                @endisset
                            >
                                {{ $temp }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
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