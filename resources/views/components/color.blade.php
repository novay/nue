@props([
    'label' => null,
    'icon' => null,
    'prepend' => null,
    'append' => null,
    'size' => null,
    'help' => null,
    'model' => null,
    'lazy' => false,
])

@php
    if ($lazy) $bind = 'lazy';
    else $bind = 'defer';
    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $key = $attributes->get('name', $model ?? $wireModel);
    $id = $attributes->get('id', $model ?? $wireModel);
    $prefix = config('laravel-bootstrap-components.use_with_model_trait') ? 'model.' : null;
    $attributes = $attributes->class([
        'form-control form-control-color',
        'form-control-' . $size => $size,
        'rounded-end' => !$append,
        'is-invalid' => $errors->has($key),
    ])->merge([
        'type' => 'color',
        'id' => $id,
        'wire:model.' . $bind => $model ? $prefix . $model : null,
    ]);
@endphp

<div>
    <x-nue::label :for="$id" :label="$label"/>

    <div class="input-group">
        <x-nue::input-addon :icon="$icon" :label="$prepend"/>

        <input {{ $attributes }}>

        <x-nue::input-addon :label="$append" class="rounded-end"/>

        <x-nue::error :key="$key"/>
    </div>

    <x-nue::help :label="$help"/>
</div>