<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-duallistbox@3.0.9/dist/bootstrap-duallistbox.min.css">
<style>
    .bootstrap-duallistbox-container select {
        padding: 10px;
        border-radius: 0;
    }
</style>

<script>
    $(document).on('pjax:end', function () {
        loadJS("https://cdn.jsdelivr.net/npm/bootstrap-duallistbox@3.0.9/dist/jquery.bootstrap-duallistbox.min.js", function () {
            var listbox = $('select[name="permissions[]"]').bootstrapDualListbox();

            $('input.filter').addClass('rounded-0');
            $('.btn.moveall i').removeClass().addClass('bi bi-arrow-right');
            $('.removeall i').removeClass().addClass('bi bi-arrow-left');
            $('.move i').removeClass().addClass('bi bi-arrow-right');
            $('.remove i').removeClass().addClass('bi bi-arrow-left');
        });
    });
</script>

<div class="card-body">
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
</div>

<div class="card-footer bg-light border-bottom d-flex p-0">
    <button type="reset" class="btn btn-secondary rounded-0 me-0">{{ __('Reset') }}</button>
    <button type="submit" class="btn btn-success rounded-0">
        <i class="bi bi-save me-1"></i>
        {{ isset($edit) ? __('Save changes') : __('Save') }}
    </button>
</div>