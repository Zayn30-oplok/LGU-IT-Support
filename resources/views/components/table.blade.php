@props([
    'columns' => [],
    'actions' => false,
])

<div
    {{ $attributes->merge([
        'class' => '
            w-full
            max-w-full
            overflow-x-auto
            rounded-lg
            bg-transparent
        ',
    ]) }}
>
    <table class="w-full min-w-[700px] text-left text-sm">

        <thead>
            @isset($header)
                {{ $header }}
            @else
                <tr class="border-b border-gray-200 bg-white">
                    @foreach ($columns as $column)
                        <th class="whitespace-nowrap px-4 py-3 text-xs font-bold uppercase tracking-wide text-gray-500">
                            {{ $column }}
                        </th>
                    @endforeach

                    @if ($actions)
                        <th class="w-1 whitespace-nowrap px-4 py-3 text-xs font-bold uppercase tracking-wide text-gray-500">
                            Actions
                        </th>
                    @endif
                </tr>
            @endisset
        </thead>

        <tbody class="font-semibold text-xs">
            {{ $body }}
        </tbody>

    </table>
</div>