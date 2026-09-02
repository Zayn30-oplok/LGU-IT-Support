@props([
    'name',
    'label' => null,
    'sublabel' => null,
    'value' => null,
    'min' => null,
    'max' => null,
    'required' => false,
    'disabled' => false,
])

<div>

    {{-- Label --}}
    @if($label || $sublabel)
        <div class="inline-flex mb-1">

            @if($label)
                <h1 class="text-xs font-semibold">
                    {{ $label }}
                </h1>
            @endif

            @if($sublabel)
                <h1 class="text-xs text-gray-400 ml-1">
                    {{ $sublabel }}
                </h1>
            @endif

        </div>
    @endif

    {{-- Input --}}
    <div class="relative">


        <input
            type="date"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ $value }}"
            @if($min) min="{{ $min }}" @endif
            @if($max) max="{{ $max }}" @endif
            @if($required) required @endif
            @if($disabled) disabled @endif

            {{ $attributes->merge([
                'class' => '
                    w-full
                    h-9
                    rounded-lg
                    border
                    border-gray-300
                    bg-white
                    px-3
                    py-2.5
                    text-sm
                    font-regular
                    text-gray-900
                    placeholder-gray-400
                    outline-none
                    transition
                    focus:border-gray-400
                    focus:ring-2
                    focus:ring-gray-100
                    ' . ($disabled ? 'bg-gray-50 text-gray-500 cursor-default' : '') . '
                '
            ]) }}
        >

    </div>

</div>
