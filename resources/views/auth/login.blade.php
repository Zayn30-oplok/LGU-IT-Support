<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">

    <title>HelpDesk Login</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>
<body class="min-h-screen">

    <x-header
        title="FixDesk"
        subtitle="Internal IT Support Portal"
        logo="{{ asset('assets/images/it.png') }}"
        background="rgba(9, 22, 40, 0.3)"
        textColor="#ffffff"
    />

    <main class="w-[calc(100%-2rem)] max-w-sm sm:max-w-none sm:w-fit h-fit px-6 py-6 sm:px-10 sm:py-8 bg-[#020d1d] rounded-xl mx-auto my-4 sm:my-8 shadow-2xl shadow-black/60">
        
        <div class="flex justify-start">
            <a
                href="{{ route('home') }}"
                title="Back"
                class="flex items-center gap-1.5 h-9 px-2.5 rounded-lg text-white hover:bg-white/10 transition-colors"
            >
                <i class="ti ti-arrow-narrow-left text-xl"></i>
                <span class="text-xs font-light"> Return </span>
            </a>
        </div>

        <div class="flex items-center justify-center w-15 h-15 mx-auto mt-2 rounded-xl bg-[#071827] text-[#2c51ec]">
            <i class="ti ti-shield-lock text-3xl"></i>
        </div>

        <h1 class="text-xl font-bold text-center text-white mt-2"> Welcome Back!</h1>
        <p class="text-center text-xs text-gray-400 mt-2"> Sign in with your credentials to access the <br> FixDesk support portal. </p>

        <form class="w-full sm:w-80 mt-10 space-y-4" method="POST" action="{{ route('login') }}">
            @csrf

            <x-input
                label="Email"
                placeholder="test@test.com"
                type="email"
                name="email"
                autocomplete="email"
                leftIcon="ti ti-mail"
                backgroundColor="#071827"
                focusColor="#2c51ec"
                iconFocusColor="#2c51ec"
            />

            <x-input class="mt-3 password-field"
                label="Password"
                placeholder="********"
                type="password"
                name="password"
                autocomplete="password"
                leftIcon="ti ti-lock"
                rightIcon="ti ti-eye-off"
                backgroundColor="#071827"
                focusColor="#2c51ec"
                iconFocusColor="#2c51ec"
            />

            <a
                href="#"
                class="block text-center text-xs text-[#2c51ec] hover:text-[#3d63ff] hover:underline mt-6 transition-colors"
            >
                Forgot Password?
            </a>

            <button
                type="button"
                class="login-button w-full mt-3 flex items-center justify-center gap-2 rounded-xl text-sm font-semibold text-white"
            >
                Sign In
                <i class="ti ti-login"></i>
            </button>

            

        </form>

        <div class="flex justify-center">
            <x-badge
                class="mt-6 text-sm font-normal"
                icon="ti ti-alert-circle"
                color="blue">
                Authorized IT Staff & Administrators Only.
            </x-badge>
        </div>
    </main>

    <script>
        document.querySelectorAll('.password-field').forEach(function (wrapper) {
            var input = wrapper.querySelector('input');
            var toggle = wrapper.querySelector('.input-icon-right');

            if (!input || !toggle) return;

            toggle.addEventListener('click', function () {
                var hidden = input.type === 'password';

                input.type = hidden ? 'text' : 'password';
                toggle.querySelector('i').className = hidden ? 'ti ti-eye' : 'ti ti-eye-off';
            });
        });
    </script>
</body>
</html>
