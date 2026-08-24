@props([
    'label' => '',
    'placeholder' => '',

    // Form integration
    'name' => null,
    'value' => null,
    'autocomplete' => null,

    // Optional icons
    'leftIcon' => null,
    'rightIcon' => null,

    'backgroundColor' => '#0f172a',
    'strokeColor' => '=> null',
    'focusColor' => '#635BFF',

    'iconColor' => '#64748b',
    'iconFocusColor' => null,

    'type' => 'text',
])

@php
    $iconFocusColor = $iconFocusColor ?? $focusColor;

    $inputClass = 'floating-input';

    if ($leftIcon) {
        $inputClass .= ' has-left-icon';
    }

    if ($rightIcon) {
        $inputClass .= ' has-right-icon';
    }
@endphp

<div
    {{ $attributes->merge([
        'class' => $inputClass,
        'style' => "
            --input-bg: {$backgroundColor};
            --input-stroke: {$strokeColor};
            --input-focus: {$focusColor};
            --input-icon: {$iconColor};
            --input-icon-focus: {$iconFocusColor};
        ",
    ]) }}
>
    <input
        type="{{ $type }}"
        placeholder="{{ $placeholder }}"
        @if ($name) name="{{ $name }}" @endif
        @if (! is_null($value)) value="{{ $value }}" @endif
        @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
    >

    @if ($label)
        <label>
            {{ $label }}
        </label>
    @endif

    {{-- Left Icon --}}
    @if ($leftIcon)
        <span class="input-icon input-icon-left">
            <i class="{{ $leftIcon }}"></i>
        </span>
    @endif

    {{-- Right Icon --}}
    @if ($rightIcon)
        <span class="input-icon input-icon-right">
            <i class="{{ $rightIcon }}"></i>
        </span>
    @endif
</div>