@props([
    'name' => null,
    'options' => [],
    'placeholder' => 'Select an option',
    'selected' => null,
    'label' => null,
    'sublabel' => null,
    'size' => 'md',
])

@php
    $sizes = [
        'sm' => 'h-8 py-1.5 pl-3 text-xs',
        'md' => 'h-9 p-2.5 text-sm',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];

    $normalized = [];

    foreach ($options as $value => $text) {
        $optionValue = is_int($value) ? $text : $value;

        $normalized[] = [
            'value' => $optionValue,
            'label' => $text,
        ];
    }

    $selectedText = null;

    foreach ($normalized as $option) {
        if ((string) $option['value'] === (string) $selected) {
            $selectedText = $option['label'];
            break;
        }
    }
@endphp

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

    {{-- Dropdown --}}
    <details
        data-dropdown
        {{ $attributes->merge([
            'class' => '
                group
                relative
                h-fit
                w-full
            ',
        ]) }}
    >
        <input
            type="hidden"
            data-dropdown-input
            name="{{ $name }}"
            value="{{ $selected ?? '' }}"
        />

        <summary
            class="
                flex
                w-full
                items-center
                justify-between
                gap-2
                cursor-pointer
                select-none
                list-none
                rounded-lg
                border
                border-gray-300
                bg-white
                pr-3
                text-gray-800
                outline-none
                transition
                focus:border-[#2c51ec]
                focus:ring-2
                focus:ring-gray-100
                [&::-webkit-details-marker]:hidden
                {{ $sizeClass }}
            "
        >
            <span
                data-dropdown-label
                class="truncate {{ $selectedText ? '' : 'text-gray-400' }}"
            >
                {{ $selectedText ?? $placeholder }}
            </span>

            <i
                class="
                    ti
                    ti-chevron-down
                    pointer-events-none
                    shrink-0
                    text-gray-500
                    transition-transform
                    duration-200
                    group-open:rotate-180
                "
            ></i>
        </summary>

        <div
            class="
                absolute
                right-0
                top-full
                z-20
                mt-1.5
                min-w-full
                w-fit
                max-h-60
                overflow-y-auto
                rounded-lg
                border
                border-gray-200
                bg-white
                shadow-lg
                focus:border-gray-400
                focus:ring-2
                focus:ring-gray-100
            "
        >

            <div
                class="
                    absolute
                    -top-[5px]
                    right-3
                    h-2.5
                    w-2.5
                    rotate-45
                    rounded-[2px]
                    border-l
                    border-t
                    border-gray-200
                    bg-white
                "
            ></div>

            @if ($placeholder !== false)
                <button
                    type="button"
                    data-dropdown-option
                    data-value=""
                    data-label="{{ $placeholder }}"
                    class="
                        flex
                        w-full
                        items-center
                        whitespace-nowrap
                        pr-3
                        text-left
                        transition-colors
                        hover:bg-[#eef4ff]
                        {{ $selectedText ? '' : 'bg-[#eef4ff]' }}
                        {{ $sizeClass }}
                    "
                >
                    {{ $placeholder }}
                </button>
            @endif

            @foreach ($normalized as $option)
                <button
                    type="button"
                    data-dropdown-option
                    data-value="{{ $option['value'] }}"
                    data-label="{{ $option['label'] }}"
                    class="
                        flex
                        w-full
                        items-center
                        whitespace-nowrap
                        pr-3
                        text-left
                        transition-colors
                        hover:bg-[#eef4ff]
                        {{ (string) $option['value'] === (string) $selected ? 'bg-[#eef4ff]' : '' }}
                        {{ $sizeClass }}
                    "
                >
                    {{ $option['label'] }}
                </button>
            @endforeach

        </div>

    </details>

</div>

<script>
    if (!window.__xDropdownInit) {
        window.__xDropdownInit = true;

        window.xDropdownSelect = function (root, value) {

            var option = root.querySelector(
                '[data-dropdown-option][data-value="' + value + '"]'
            );

            if (!option) {
                return;
            }

            var input = root.querySelector('[data-dropdown-input]');
            var label = root.querySelector('[data-dropdown-label]');

            if (input) {
                input.value = option.dataset.value;
            }

            if (label) {
                label.textContent = option.dataset.label;
                label.classList.remove('text-gray-400');
            }

            root.querySelectorAll('[data-dropdown-option]').forEach(function (item) {
                item.classList.toggle(
                    'bg-[#eef4ff]',
                    item === option
                );
            });

            root.removeAttribute('open');

            root.dispatchEvent(
                new CustomEvent('dropdown-change', {
                    bubbles: true
                })
            );
        };

        document.addEventListener('click', function (event) {

            var option = event.target.closest(
                '[data-dropdown-option]'
            );

            if (option) {

                var root = option.closest(
                    'details[data-dropdown]'
                );

                window.xDropdownSelect(
                    root,
                    option.dataset.value
                );

                return;
            }

            document
                .querySelectorAll('details[data-dropdown][open]')
                .forEach(function (root) {

                    if (!root.contains(event.target)) {
                        root.removeAttribute('open');
                    }

                });
        });
    }
</script>
