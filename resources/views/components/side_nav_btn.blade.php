@props([
    'icon' => 'ti ti-circle',
    'label' => 'Label',
    'href' => '#',
    'active' => false,
])

<a
    href="{{ $href }}"
    data-sidebar-link
    data-sidebar-btn
    data-nav-label
    @if($active)
        data-active="true"
    @else
        data-active="false"
    @endif
    {{ $attributes->except(['href', 'class']) }}
    class="
        relative
        flex
        h-10
        items-center
        gap-3
        rounded-md
        px-3
        text-sm
        transition-colors
        {{ $active
            ? 'font-semibold text-[#071f45]'
            : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
        }}
    "
>
    @if($active)
        <span
            data-active-indicator
            class="
                absolute
                left-0
                top-1/2
                h-7
                w-1
                -translate-y-1/2
                rounded-full
                bg-[#071f45]
            "
        ></span>
    @endif

    <i class="{{ $icon }} text-lg shrink-0"></i>

    <span
        data-nav-label
        class="truncate"
    >
        {{ $label }}
    </span>
</a>