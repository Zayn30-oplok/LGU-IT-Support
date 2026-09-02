<?php

use Livewire\Component;
use Carbon\Carbon;

new class extends Component
{
    public int $week;

    public function mount(): void
    {
        $this->week = (int) ceil(date('j') / 7);
    }

    public function with(): array
    {
        return [
            'weeks' => range(1, 5),

            'currentWeek' => (int) ceil(date('j') / 7),

            'chart' => $this->chartData(),
        ];
    }

    private function chartData(): array
    {
        $days = [
            'Mon',
            'Tue',
            'Wed',
            'Thu',
            'Fri',
            'Sat',
            'Sun',
        ];

        $hardware = [];
        $software = [];
        $network = [];

        mt_srand($this->week);

        foreach ($days as $day) {
            $hardware[] = mt_rand(0, 50);
            $software[] = mt_rand(0, 8);
            $network[] = mt_rand(0, 2);
        }

        return [
            'week' => $this->week,

            'labels' => $days,

            'hardware' => $hardware,
            'software' => $software,
            'network' => $network,
        ];
    }
};

?>

<div class="h-full">
    @assets
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.9/dist/chart.umd.min.js"></script>
    @endassets

    <div class="flex h-full flex-col gap-4 rounded-lg bg-white p-4 shadow-sm">

        <div class="flex items-center justify-between gap-3">

            <p class="text-xs font-bold text-gray-800">
                WEEKLY TICKET REQUEST
            </p>

            <div wire:ignore class="flex items-center gap-2">

                {{-- Reset week button --}}
                <button
                    type="button"
                    data-reset-range
                    title="Back to week 1"
                    style="display: none;"
                    class="
                        flex
                        h-7
                        w-7
                        shrink-0
                        items-center
                        justify-center
                        rounded-full
                        text-gray-500
                        transition-colors
                        hover:bg-gray-100
                        hover:text-gray-800
                    "
                >
                    <i class="ti ti-reload text-sm"></i>
                </button>

                {{-- Week dropdown --}}
                <x-dropdown
                    name="week"
                    :options="$weeks"
                    placeholder="Week"
                    :selected="$week"
                    size="sm"
                    data-default="{{ $currentWeek }}"
                    class="w-15"
                />

            </div>

        </div>

        {{-- Chart data bridge --}}
        <script type="application/json" data-chart-data>
            @json($chart)
        </script>

        <div class="relative flex flex-1 items-center justify-center">
            <div class="relative h-60 w-60">
                <canvas data-weekly-chart></canvas>
            </div>
        </div>

    </div>

    @script
        <script>
            const root = document
                .querySelector('[data-weekly-chart]')
                .closest('[wire\\:id]');

            const canvas = root.querySelector('[data-weekly-chart]');

            const resetButton = root.querySelector(
                '[data-reset-range]'
            );

            let chart = null;

            /**
             * Get the latest chart data from Livewire.
             */
            function chartPayload() {
                return JSON.parse(
                    root.querySelector('[data-chart-data]').textContent
                );
            }

            /**
             * Draw / redraw the chart.
             */
            function drawChart() {

                const payload = chartPayload();

                if (typeof Chart === 'undefined' || !payload) {
                    return;
                }

                if (chart) {
                    chart.destroy();
                }

                chart = new Chart(
                    canvas.getContext('2d'),
                    {
                        type: 'doughnut',

                        data: {
                            labels: ['Hardware', 'Software', 'Network'],

                            datasets: [
                                {
                                    data: [
                                        payload.hardware.reduce((a, b) => a + b, 0),
                                        payload.software.reduce((a, b) => a + b, 0),
                                        payload.network.reduce((a, b) => a + b, 0),
                                    ],

                                    backgroundColor: [
                                        '#071f45',
                                        '#1E4079',
                                        '#1FC2C4',
                                    ],

                                    borderColor: '#ffffff',

                                    borderWidth: 2,
                                },
                            ],
                        },

                        options: {
                            responsive: true,

                            maintainAspectRatio: false,

                            plugins: {

                                legend: {
                                    position: 'bottom',

                                    labels: {
                                        usePointStyle: true,
                                        pointStyle: 'circle',

                                        boxWidth: 8,
                                        boxHeight: 8,

                                        padding: 16,

                                        font: {
                                            size: 12,
                                            weight: '600',
                                        },
                                    },
                                },

                                tooltip: {

                                    callbacks: {

                                        label: (item) => {
                                            const total = item.dataset.data.reduce((a, b) => a + b, 0);
                                            const value = item.parsed;
                                            const percentage = total > 0
                                                ? ((value / total) * 100).toFixed(1)
                                                : 0;

                                            return `${item.label}: ${value} (${percentage}%)`;
                                        },
                                    },

                                    boxPadding: 3,
                                },
                            },
                        },
                    }
                );
            }

            /**
             * Send selected week to Livewire.
             */
            function syncWeekToComponent() {

                const weekInput = root.querySelector(
                    '[data-dropdown-input][name="week"]'
                );

                if (!weekInput) {
                    return;
                }

                const weekValue = parseInt(
                    weekInput.value,
                    10
                );

                if (Number.isNaN(weekValue)) {
                    return;
                }

                $wire
                    .set('week', weekValue)
                    .then(() => {

                        updateResetVisibility();

                        drawChart();
                    });
            }

            /**
             * Show the reset button only when
             * the selected week is different
             * from the default week.
             */
            function updateResetVisibility() {

                const weekDropdown = root.querySelector(
                    'details[data-dropdown][data-default]'
                );

                if (!weekDropdown) {
                    return;
                }

                const input = weekDropdown.querySelector(
                    '[data-dropdown-input]'
                );

                if (!input) {
                    return;
                }

                const changed =
                    input.value !== '' &&
                    input.value !==
                    weekDropdown.dataset.default;

                resetButton.style.display =
                    changed ? '' : 'none';
            }

            /**
             * Detect week dropdown changes.
             */
            document.addEventListener(
                'dropdown-change',
                (event) => {

                    if (!root.contains(event.target)) {
                        return;
                    }

                    syncWeekToComponent();
                }
            );

            /**
             * Reset back to the default week.
             */
            resetButton.addEventListener(
                'click',
                () => {

                    const weekDropdown = root.querySelector(
                        'details[data-dropdown][data-default]'
                    );

                    if (!weekDropdown) {
                        return;
                    }

                    const input = weekDropdown.querySelector(
                        '[data-dropdown-input]'
                    );

                    if (!input) {
                        return;
                    }

                    const defaultWeek =
                        weekDropdown.dataset.default;

                    if (input.value === defaultWeek) {
                        return;
                    }

                    window.xDropdownSelect(
                        weekDropdown,
                        defaultWeek
                    );
                }
            );

            /**
             * Initial state.
             */
            updateResetVisibility();
            drawChart();
        </script>
    @endscript

</div>
