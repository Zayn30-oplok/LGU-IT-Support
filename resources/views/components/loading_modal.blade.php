@props([
    'id' => 'loading-modal',
    'text' => 'Loading...',
])

<style>
    @keyframes radial-spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @keyframes radial-pulse {
        0%, 100% { opacity: 0.4; }
        50% { opacity: 1; }
    }

    .loading-radial {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        position: relative;
        animation: radial-spin 1.2s linear infinite;
    }

    .loading-radial::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 4px solid transparent;
        border-top-color: #635BFF;
        border-right-color: #635BFF;
    }

    .loading-radial::after {
        content: '';
        position: absolute;
        inset: 6px;
        border-radius: 50%;
        border: 4px solid transparent;
        border-bottom-color: #a5a3ff;
        border-left-color: #a5a3ff;
        animation: radial-spin 0.8s linear infinite reverse;
    }

    .loading-text {
        animation: radial-pulse 1.5s ease-in-out infinite;
    }
</style>

<div
    id="{{ $id }}"
    data-modal
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-3 sm:p-4"
>
    <div
        class="flex w-full max-w-xs flex-col items-center justify-center
               rounded-2xl bg-white px-8 py-10 shadow-xl"
    >

        {{-- Radial Spinner --}}
        <div class="loading-radial mb-5"></div>

        {{-- Changeable Text --}}
        <p class="loading-text text-sm font-medium text-gray-700 text-center">
            {{ $text }}
        </p>

    </div>
</div>
