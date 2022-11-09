<script>
    $(document).on('pjax:end', function () {
        Nue.components.NueTomSelect.init('.js-select');
    });
</script>

<div class="card-body">
    <div class="row gx-3">
        <div class="col-md-2">
            <div class="form-group mb-3">
                <label class="form-label text-cap text-muted mb-1" for="photo">
                    {{ __('Photo') }}
                </label>
                <div class="d-block align-items-center">
                    <label class="avatar avatar-xxl avatar-rounded mb-2" for="avatarUploader">
                        @isset($edit)
                            <img id="avatarImg" class="avatar-img" src="{{ $edit->photo_url }}" alt="">
                        @else
                            <img id="avatarImg" class="avatar-img" src="https://cdn.btekno.id/templates/v2/img/160x160/img1.jpg" alt="">
                        @endisset
                    </label>

                    <div class="d-flex">
                        <div class="form-attachment-btn btn btn-xs btn-primary rounded-0">
                            {{ __('Upload') }} {{ strtolower(__('Photo')) }}
                            <input type="file" class="js-file-attach form-attachment-btn-label" id="avatarUploader" name="photo" 
                            data-nue-file-attach-options='{
                                "textTarget": "#avatarImg",
                                "mode": "image",
                                "targetAttr": "src",
                                "resetTarget": ".js-file-attach-reset-img",
                                "resetImg": "https://cdn.btekno.id/templates/v2/img/160x160/img1.jpg",
                                "allowTypes": [".png", ".jpeg", ".jpg"]
                            }'>
                        </div>
                        <button type="button" class="js-file-attach-reset-img btn btn-white btn-xs rounded-0 ms-1">
                            {{ __('Delete') }}
                        </button>
                    </div>
                </div>
                {!! $errors->first('photo', ' <span class="invalid-feedback">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="divider-center mb-3 text-cap text-dark">User ID</div>
            
            <div class="form-group mb-3">
                <label class="form-label text-cap text-muted mb-1" for="name">
                    {{ __('Name') }} <span class="text-danger">*</span>
                </label>
                {!! Form::text('name', null, ['class' => 'form-control form-control-sm rounded-0' . $errors->first('name', ' is-invalid'), 'placeholder' => 'eg. Noviyanto Rahmadi']) !!}
                {!! $errors->first('name', ' <span class="invalid-feedback">:message</span>') !!}
            </div>

            <div class="form-group mb-3">
                <label class="form-label text-cap text-muted mb-1" for="email">
                    {{ __('Email') }} <span class="text-danger">*</span>
                </label>
                {!! Form::text('email', null, ['class' => 'form-control form-control-sm rounded-0' . $errors->first('email', ' is-invalid'), 'placeholder' => 'eg. novay@btekno.id']) !!}
                {!! $errors->first('email', ' <span class="invalid-feedback">:message</span>') !!}
            </div>

            <div class="form-group mb-3">
                <label class="form-label text-cap text-muted mb-1" for="password">
                    {{ __('Password') }} 
                    @if(!isset($edit))
                        <span class="text-danger">*</span>
                    @endif
                </label>
                <div class="input-group input-group-merge rounded-0 {{ $errors->first('password', ' is-invalid') }}" data-nue-validation-validate-class>
                    <input type="password" class="js-toggle-password form-control form-control-sm rounded-0" name="password" placeholder="{{ __('Password Placeholder') }}" aria-label="{{ __('Password Placeholder') }}"
                    data-nue-toggle-password-options='{
                        "target": "#new-target",
                        "defaultClass": "bi-eye-slash",
                        "showClass": "bi-eye",
                        "classChangeTarget": "#new-icon"
                    }'>
                    <a id="new-target" class="input-group-append input-group-text" href="javascript:;">
                        <i id="new-icon" class="bi-eye"></i>
                    </a>
                </div>
                {!! $errors->first('password', ' <span class="invalid-feedback">:message</span>') !!}
            </div>

            <div class="form-group mb-3">
                <label class="form-label text-cap text-muted mb-1" for="password_confirmation">
                    {{ __('Confirm Password') }}
                    @if(!isset($edit))
                        <span class="text-danger">*</span>
                    @endif
                </label>
                <div class="input-group input-group-merge rounded-0 {{ $errors->first('password_confirmation', ' is-invalid') }}" data-nue-validation-validate-class>
                    <input type="password" class="js-toggle-password form-control form-control-sm rounded-0" name="password_confirmation" placeholder="{{ __('Password Placeholder') }}" aria-label="{{ __('Password Placeholder') }}"
                    data-nue-toggle-password-options='{
                        "target": "#confirm-target",
                        "defaultClass": "bi-eye-slash",
                        "showClass": "bi-eye",
                        "classChangeTarget": "#confirm-icon"
                    }'>
                    <a id="confirm-target" class="input-group-append input-group-text" href="javascript:;">
                        <i id="confirm-icon" class="bi-eye"></i>
                    </a>
                </div>
                {!! $errors->first('password_confirmation', ' <span class="invalid-feedback">:message</span>') !!}
            </div>

        </div>
        <div class="col-md-6">
            <div class="divider-center mb-3 text-cap text-dark">
                {{ __('Roles & Permissions') }}
            </div>
            <div class="form-group mb-2">
                <label class="form-label text-cap text-muted mb-1" for="roles[]">
                    {{ __('Roles') }}
                </label>
                <div class="tom-select-custom tom-select-custom-with-tags">
                    <select class="js-select form-select" autocomplete="off" multiple name="roles[]" 
                        data-nue-tom-select-options='{
                            "hideSearch": true,
                            "placeholder": "Select roles ..."
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
                {!! $errors->first('roles[]', ' <span class="invalid-feedback">:message</span>') !!}
            </div>

            <div class="form-group mb-2">
                <label class="form-label text-cap text-muted mb-1" for="permissions[]">
                    {{ __('Permissions') }} 
                </label>
                <div class="tom-select-custom tom-select-custom-with-tags">
                    <select class="js-select form-select" autocomplete="off" multiple name="permissions[]" 
                        data-nue-tom-select-options='{
                            "hideSearch": true,
                            "placeholder": "Select permissions ..."
                        }'>
                        @foreach(config('nue.database.permissions_model')::pluck('name', 'id') as $i => $temp)
                            <option value="{{ $i }}"
                                @isset($edit)
                                    {{ in_array($i, $edit->permissions()->pluck('id')->toArray()) ? 'selected' : '' }}
                                @endisset
                            >
                                {{ $temp }}
                            </option>
                        @endforeach>
                    </select>
                </div>
                {!! $errors->first('permissions[]', ' <span class="invalid-feedback">:message</span>') !!}
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