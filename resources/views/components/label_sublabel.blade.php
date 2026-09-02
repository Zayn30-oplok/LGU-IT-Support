@props([
    'label',
    'sublabel',
    'labelSize' => 'text-sm',
    'sublabelSize' => 'text-sm',
])

<div {{ $attributes->merge(['class' => 'flex flex-col']) }}>

    <span class="{{ $labelSize }} font-bold text-gray-900">
        {{ $label }}
    </span>

    <span class="{{ $sublabelSize }} font-semibold text-gray-600">
        {{ $sublabel }}
    </span>

</div>
