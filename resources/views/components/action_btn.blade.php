@props([
    'icon',
    'color' => 'blue',
    'type' => 'button',
    'title' => null,
    'href' => null,
])

@php
    $colors = [
        'blue' => [
            'bg' => 'bg-blue-600',
            'hover' => 'hover:bg-blue-700',
        ],

        'green' => [
            'bg' => 'bg-green-600',
            'hover' => 'hover:bg-green-700',
        ],

        'red' => [
            'bg' => 'bg-red-600',
            'hover' => 'hover:bg-red-700',
        ],

        'yellow' => [
            'bg' => 'bg-yellow-500',
            'hover' => 'hover:bg-yellow-600',
        ],

        'orange' => [
            'bg' => 'bg-orange-600',
            'hover' => 'hover:bg-orange-700',
        ],

        'purple' => [
            'bg' => 'bg-purple-600',
            'hover' => 'hover:bg-purple-700',
        ],

        'gray' => [
            'bg' => 'bg-gray-600',
            'hover' => 'hover:bg-gray-700',
        ],

        'd-blue' => [
            'bg' => 'bg-[#071f45]',
            'hover' => 'hover:bg-[#051832]',
        ],

        
    ];

    $selectedColor = $colors[$color] ?? $colors['blue'];

    $classes = "
        inline-flex
        h-7
        w-7
        shrink-0
        items-center
        justify-center
        rounded-md
        cursor-pointer
        transition-all
        duration-200
        ease-in-out

        {$selectedColor['bg']}
        {$selectedColor['hover']}

        hover:shadow-sm
        active:scale-95

        disabled:pointer-events-none
        disabled:cursor-not-allowed
        disabled:opacity-50
    ";
@endphp

@if($href)

    <a
        href="{{ $href }}"
        @if($title) title="{{ $title }}" @endif
        {{ $attributes->merge([
            'class' => $classes,
        ]) }}
    >
        <i class="{{ $icon }} text-xs text-white"></i>
    </a>

@else

    <button
        type="{{ $type }}"
        @if($title) title="{{ $title }}" @endif
        {{ $attributes->merge([
            'class' => $classes,
        ]) }}
    >
        <i class="{{ $icon }} text-xs text-white"></i>
    </button>

@endif
