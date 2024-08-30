@props(['type' => 'submit'])

@php
    $attributes = $attributes->class(['btn']);

    $type = $attributes->get('type') ?? $type;

    $attributes = $attributes->except('type');

    $attributes = $attributes->class(['btn-primary']);
@endphp

<button type="{{ $type }}" class="btn" {{ $attributes }} style="background-color: #4D869C; color: #ffffff;">
    {{ $slot }}
</button>
