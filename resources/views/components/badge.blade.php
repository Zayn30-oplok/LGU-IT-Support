@props([
    'icon' => null,
    'label' => null,
    'color' => 'blue',
])

@php
    $colors = [
        'blue' => [
            'bg' => 'rgba(59, 130, 246, 0.10)',
            'text' => '#60a5fa',
            'border' => 'rgba(59, 130, 246, 0.30)',
        ],

        'green' => [
            'bg' => 'rgba(34, 197, 94, 0.10)',
            'text' => '#4ade80',
            'border' => 'rgba(34, 197, 94, 0.30)',
        ],

        'yellow' => [
            'bg' => 'rgba(234, 179, 8, 0.10)',
            'text' => '#facc15',
            'border' => 'rgba(234, 179, 8, 0.30)',
        ],

        'red' => [
            'bg' => 'rgba(239, 68, 68, 0.10)',
            'text' => '#f87171',
            'border' => 'rgba(239, 68, 68, 0.30)',
        ],

        'cyan' => [
            'bg' => 'rgba(6, 182, 212, 0.10)',
            'text' => '#22d3ee',
            'border' => 'rgba(6, 182, 212, 0.30)',
        ],

        'purple' => [
            'bg' => 'rgba(168, 85, 247, 0.10)',
            'text' => '#c084fc',
            'border' => 'rgba(168, 85, 247, 0.30)',
        ],

        'gray' => [
            'bg' => 'rgba(107, 114, 128, 0.10)',
            'text' => '#9ca3af',
            'border' => 'rgba(107, 114, 128, 0.30)',
        ],

        'orange' => [
            'bg' => 'rgba(249, 115, 22, 0.10)',
            'text' => '#fb923c',
            'border' => 'rgba(249, 115, 22, 0.30)',
        ],
    ];

    $selectedColor = $colors[$color] ?? $colors['blue'];
@endphp

<span
    {{ $attributes->merge([
        'class' => '
            inline-flex
            items-center
            gap-1.5
            rounded-full
            border
            px-3
            py-1
            text-xs
            font-semibold
            whitespace-nowrap
        ',
        'style' => "
            background-color: {$selectedColor['bg']};
            color: {$selectedColor['text']};
            border-color: {$selectedColor['border']};
        ",
    ]) }}
>
    @if ($icon)
        <i class="{{ $icon }} text-[0.7rem]"></i>
    @endif

    <span class="text-[0.7rem]">
        {{ $label ?? $slot }}
    </span>
</span>