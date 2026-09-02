<?php

use Livewire\Component;
use Carbon\Carbon;

new class extends Component
{
    public int $year;

    public function mount(): void
    {
        $this->year = (int) date('Y');
    }

    public function with(): array
    {
        return [
            'years' => range((int) date('Y'), 2020),

            'currentYear' => (int) date('Y'),

            'chart' => $this->chartData(),
        ];
    }

    /**
     * Monthly ticket request data.
     *
     * Displays January to December.
     * Future months of the current year have 0 data.
     */
    private function chartData(): array
    {
        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];

        $currentYear = (int) date('Y');
        $currentMonth = (int) date('n');

        mt_srand($this->year);

        $hardware = [];
        $software = [];
        $network = [];
        $totals = [];

        foreach ($months as $index => $month) {

            $monthNumber = $index + 1;

            /*
             * If the selected year is the current year,
             * future months should have no data yet.
             *
             * If an older year is selected, all 12 months
             * can have data.
             */
            if (
                $this->year === $currentYear &&
                $monthNumber > $currentMonth
            ) {
                $hardware[] = 0;
                $software[] = 0;
                $network[] = 0;
                $totals[] = 0;

                continue;
            }

            /*
             * Sample data.
             * Replace this with your actual ticket queries later.
             */
            $h = mt_rand(0, 30);
            $s = mt_rand(0, 25);
            $n = mt_rand(0, 20);

            $hardware[] = $h;
            $software[] = $s;
            $network[] = $n;
            $totals[] = $h + $s + $n;
        }

        return [
            'year' => $this->year,

            'labels' => $months,

            'hardware' => $hardware,
            'software' => $software,
            'network' => $network,
            'totals' => $totals,
        ];
    }
};

?>

<div class="h-full">
    @assets
        <script
            src="https://cdn.jsdelivr.net/npm/chart.js@4.4.9/dist/chart.umd.min.js"
        ></script>
    @endassets

    <div class="flex h-full flex-col gap-4 rounded-lg bg-white p-4 shadow-sm">

        <div class="flex items-center justify-between gap-3">

            <p class="text-xs font-bold text-gray-800">
                MONTHLY TICKET REQUEST
            </p>

            <div wire:ignore class="flex items-center gap-2">

                {{-- Reset year button --}}
                <button
                    type="button"
                    data-reset-range
                    title="Back to current year"
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

                {{-- Year dropdown --}}
                <x-dropdown
                    name="year"
                    :options="$years"
                    placeholder="Year"
                    :selected="$year"
                    size="sm"
                    data-default="{{ $currentYear }}"
                    class="w-24"
                />

            </div>

        </div>

        {{-- Chart data bridge --}}
        <script type="application/json" data-chart-data>
            @json($chart)
        </script>

        <div class="relative w-full flex-1">
            <div class="relative h-72 w-full">
                <canvas data-monthly-chart></canvas>
            </div>
        </div>

    </div>

    @script
        <script>
            const root = document
                .querySelector('[data-monthly-chart]')
                .closest('[wire\\:id]');

            const canvas = root.querySelector(
                '[data-monthly-chart]'
            );

            const resetButton = root.querySelector(
                '[data-reset-range]'
            );

            let chart = null;

            /**
             * Get the latest chart data from Livewire.
             */
            function chartPayload() {
                return JSON.parse(
                    root
                        .querySelector('[data-chart-data]')
                        .textContent
                );
            }

            /**
             * Create a vertical gradient.
             *
             * Top = 100% opacity.
             * Bottom = 20% opacity.
             */
            function createGradient(context, chartArea) {

                const blue = '#2c51ec';

                const gradient = context.createLinearGradient(
                    0,
                    chartArea.top,
                    0,
                    chartArea.bottom
                );

                gradient.addColorStop(
                    0,
                    'rgb(98, 128, 245, 1)'
                );

                gradient.addColorStop(
                    1,
                    'rgba(98, 128, 245, 0.1)'
                );

                return gradient;
            }

            /**
             * Draw / redraw the chart.
             */
            function drawChart() {

                const payload = chartPayload();

                if (
                    typeof Chart === 'undefined' ||
                    !payload
                ) {
                    return;
                }

                if (chart) {
                    chart.destroy();
                }

                const blue = '#2c51ec';

                chart = new Chart(
                    canvas.getContext('2d'),
                    {
                        type: 'line',

                        data: {
                            labels: payload.labels,

                            datasets: [
                                {
                                    label: `Ticket Requests ${payload.year}`,

                                    data: payload.totals,

                                    borderColor: blue,

                                    /**
                                     * Gradient fill.
                                     *
                                     * chartArea is available after
                                     * Chart.js calculates the layout.
                                     */
                                    backgroundColor: (context) => {

                                        const {
                                            chart,
                                            chartArea,
                                        } = context;

                                        const gradient = chart.ctx.createLinearGradient(
                                            0,
                                            0,
                                            0,
                                            chart.canvas.height
                                        );

                                        gradient.addColorStop(
                                            0,
                                            'rgba(44, 81, 236, 1)'
                                        );

                                        gradient.addColorStop(
                                            1,
                                            'rgba(44, 81, 236, 0.2)'
                                        );

                                        if (!chartArea) {
                                            return gradient;
                                        }

                                        return gradient;
                                    },

                                    fill: true,

                                    tension: 0.35,

                                    borderWidth: 2,

                                    pointRadius: 3,

                                    pointHoverRadius: 5,

                                    pointBackgroundColor: blue,

                                    pointBorderColor: '#ffffff',

                                    pointBorderWidth: 2,
                                },
                            ],
                        },

                        options: {
                            responsive: true,

                            maintainAspectRatio: false,

                            interaction: {
                                mode: 'index',
                                intersect: false,
                            },

                            plugins: {

                                legend: {
                                    position: 'bottom',

                                    labels: {
                                        usePointStyle: true,
                                        pointStyle: 'circle',

                                        boxWidth: 6,
                                        boxHeight: 6,

                                        padding: 16,
                                    },
                                },

                                tooltip: {

                                    callbacks: {

                                        title: (items) => {
                                            return `${items[0].label} ${payload.year}`;
                                        },

                                        label: (item) => {
                                            return `Ticket Requests: ${item.parsed.y}`;
                                        },

                                        footer: (items) => {

                                            const index =
                                                items[0].dataIndex;

                                            return [
                                                `Hardware: ${payload.hardware[index]}`,
                                                `Software: ${payload.software[index]}`,
                                                `Network: ${payload.network[index]}`,
                                                `Total: ${payload.totals[index]}`,
                                            ];
                                        },
                                    },

                                    footerBorderColor: '#e5e7eb',

                                    footerFont: {
                                        weight: 'bold',
                                    },

                                    boxPadding: 3,
                                },
                            },

                            scales: {

                                x: {
                                    ticks: {
                                        autoSkip: false,
                                    },

                                    grid: {
                                        display: false,
                                    },
                                },

                                y: {
                                    beginAtZero: true,

                                    ticks: {
                                        precision: 0,
                                    },
                                },
                            },
                        },
                    }
                );
            }

            /**
             * Send selected year to Livewire.
             */
            function syncYearToComponent() {

                const yearInput = root.querySelector(
                    '[data-dropdown-input][name="year"]'
                );

                if (!yearInput) {
                    return;
                }

                const yearValue = parseInt(
                    yearInput.value,
                    10
                );

                if (Number.isNaN(yearValue)) {
                    return;
                }

                $wire
                    .set('year', yearValue)
                    .then(() => {

                        updateResetVisibility();

                        drawChart();
                    });
            }

            /**
             * Show the reset button only when
             * the selected year is different
             * from the current year.
             */
            function updateResetVisibility() {

                const yearDropdown = root.querySelector(
                    'details[data-dropdown][data-default]'
                );

                if (!yearDropdown) {
                    return;
                }

                const input = yearDropdown.querySelector(
                    '[data-dropdown-input]'
                );

                if (!input) {
                    return;
                }

                const changed =
                    input.value !== '' &&
                    input.value !==
                    yearDropdown.dataset.default;

                resetButton.style.display =
                    changed ? '' : 'none';
            }

            /**
             * Detect year dropdown changes.
             */
            document.addEventListener(
                'dropdown-change',
                (event) => {

                    if (!root.contains(event.target)) {
                        return;
                    }

                    syncYearToComponent();
                }
            );

            /**
             * Reset back to the current year.
             */
            resetButton.addEventListener(
                'click',
                () => {

                    const yearDropdown = root.querySelector(
                        'details[data-dropdown][data-default]'
                    );

                    if (!yearDropdown) {
                        return;
                    }

                    const input = yearDropdown.querySelector(
                        '[data-dropdown-input]'
                    );

                    if (!input) {
                        return;
                    }

                    const defaultYear =
                        yearDropdown.dataset.default;

                    if (input.value === defaultYear) {
                        return;
                    }

                    window.xDropdownSelect(
                        yearDropdown,
                        defaultYear
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