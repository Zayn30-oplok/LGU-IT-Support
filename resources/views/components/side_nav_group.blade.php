@props([
    'icon' => 'ti ti-users',
    'label' => 'Label',
    'active' => false,
    'open' => false,
])

<details
    data-sidebar-group
    @if($active)
        data-active="true"
    @else
        data-active="false"
    @endif
    @if($open)
        open
    @endif
    {{ $attributes->merge(['class' => 'group']) }}
>
    <summary
        class="
            relative
            flex
            items-center
            gap-5
            px-4
            h-10
            cursor-pointer
            select-none
            list-none
            text-sm
            text-gray-600
            hover:bg-gray-100
            hover:text-gray-900
            hover:font-semibold
            transition-colors
            duration-200
            [&::-webkit-details-marker]:hidden
            {{ $active
                ? 'font-semibold text-[#071f45]'
                : ''
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

        <i class="{{ $icon }} shrink-0 text-xl"></i>

        <span class="flex-1">{{ $label }}</span>

        <i class="ti ti-chevron-right text-base transition-transform duration-200 group-open:rotate-90"></i>
    </summary>

    <div class="my-1 ml-11 mr-4 flex flex-col">
        {{ $slot }}
    </div>
</details>
