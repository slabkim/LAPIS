<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LAPIS Disdukcapil Bandar Lampung</title>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Public Sans', sans-serif;
        }
    </style>
</head>

<body class="h-full bg-gray-50">
    <div class="flex w-full h-full">
        <!-- Left Side: Login Form -->
        <div class="relative z-10 flex flex-col w-full h-full bg-white shadow-2xl lg:w-1/2">
            <!-- Header Logo Area -->
            <div class="flex items-center gap-3 px-6 py-6 sm:px-8 sm:py-8 sm:pt-12 sm:pl-11">
                <div
                    class="flex items-center justify-center w-12 h-12 border rounded-lg bg-black/10 backdrop-blur-sm border-black/20">
                    <img src="{{ asset('assets/images/Logo_balam.png') }}" alt="Logo Bandar Lampung"
                        class="object-contain size-10">
                </div>
                <div>
                    <h1 class="text-2xl font-bold leading-none tracking-tight text-gray-900">LAPIS</h1>
                    <p class="text-xs font-medium tracking-wider text-gray-500 uppercase">Disdukcapil Bandar Lampung</p>
                </div>
            </div>


            <!-- Scrollable Form Content -->
            <div class="flex flex-col items-center justify-center flex-1 px-6 py-6 sm:px-8 sm:py-4 overflow-y-auto">
                <div class="w-full max-w-md space-y-6 sm:space-y-8">
                    <!-- Welcome Text -->
                    <div class="space-y-2">
                        <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Selamat Datang</h2>
                        <p class="text-sm text-gray-500 sm:text-base">
                            Silakan masuk untuk mengakses layanan pengaduan dan penilaian pelayanan publik.
                        </p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-4 text-sm font-medium text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Form Inputs -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <!-- Email Field -->
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-900" for="email">Email</label>
                            <div class="relative">
                                <span
                                    class="absolute text-gray-400 -translate-y-1/2 material-symbols-outlined left-4 top-1/2">mail</span>
                                <input
                                    class="w-full h-12 pr-4 transition-all border-gray-200 rounded-lg bg-gray-50 pl-11 focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder:text-gray-400"
                                    id="email" name="email" placeholder="nama@email.com" type="email"
                                    value="{{ old('email') }}" required autofocus autocomplete="username" />
                            </div>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <label class="text-sm font-semibold text-gray-900" for="password">Password</label>
                                @if (Route::has('password.request'))
                                    <a class="text-sm font-medium text-blue-600 hover:text-blue-700 hover:underline"
                                        href="{{ route('password.request') }}">
                                        Lupa Password?
                                    </a>
                                @endif
                            </div>
                            <div class="relative">
                                <span
                                    class="absolute text-gray-400 -translate-y-1/2 material-symbols-outlined left-4 top-1/2">lock</span>
                                <input
                                    class="w-full h-12 pr-12 transition-all border-gray-200 rounded-lg bg-gray-50 pl-11 focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder:text-gray-400"
                                    id="password" name="password" placeholder="Masukkan password" type="password"
                                    required autocomplete="current-password" />
                                <button
                                    class="absolute text-gray-400 -translate-y-1/2 right-4 top-1/2 hover:text-gray-600"
                                    type="button" onclick="togglePassword()">
                                    <span class="material-symbols-outlined text-[20px]"
                                        id="toggleIcon">visibility</span>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="remember_me" class="ml-2 text-sm text-gray-600">Ingat saya</label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="flex items-center justify-center w-full h-12 gap-2 font-bold text-white transition-all bg-blue-600 rounded-lg shadow-lg hover:bg-blue-700 shadow-blue-500/30 group">
                            <span>Masuk</span>
                            <span
                                class="text-sm transition-transform material-symbols-outlined group-hover:translate-x-1">arrow_forward</span>
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="relative py-2">
                        <div class="absolute inset-0 flex items-center">
                            <span class="w-full border-t border-gray-200"></span>
                        </div>
                        <div class="relative flex justify-center text-xs uppercase">
                            <span class="px-2 text-gray-500 bg-white">Atau masuk dengan</span>
                        </div>
                    </div>

                    <!-- Google Login Button -->
                    <a href="{{ route('auth.google') }}"
                        class="flex items-center justify-center w-full h-12 gap-3 font-medium text-gray-700 transition-all bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#4285F4"
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                            <path fill="#34A853"
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                            <path fill="#FBBC05"
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                            <path fill="#EA4335"
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                        </svg>
                        <span>Masuk dengan Google</span>
                    </a>

                    <!-- Footer / Register Link -->
                    <div class="pt-2 text-center">
                        <p class="text-sm text-gray-600">
                            Belum punya akun?
                            <a class="font-bold text-blue-600 hover:text-blue-700 hover:underline"
                                href="{{ route('register') }}">Daftar sekarang</a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Footer Small Print -->
            <div class="px-6 py-4 text-center sm:px-8">
                <p class="text-xs text-gray-400">© 2024 Disdukcapil Kota Bandar Lampung. All rights reserved.</p>
            </div>
        </div>

        <!-- Right Side: Decorative Image / Illustration -->
        <div
            class="relative flex-col justify-between hidden w-1/2 p-12 overflow-hidden text-white lg:flex bg-slate-900">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 z-10 bg-gradient-to-b from-blue-900/90 to-slate-900/95 mix-blend-multiply">
                </div>
                <div class="w-full h-full bg-center bg-cover opacity-60"
                    style="background-image: url('{{ asset('assets/images/Background_LAPIS.png') }}');"></div>
            </div>

            <!-- Content on top of background -->
            <div class="relative z-20 flex flex-col justify-between h-full">

                <!-- Welcome Text -->
                <div class="my-auto mb-12 py-60">
                    <div class="w-16 h-1 mb-6 bg-red-600"></div>
                    <h2 class="mb-4 text-4xl font-bold leading-tight tracking-tight">
                        Melayani Sepenuh Hati,<br />
                        <span class="text-yellow-400">Membangun Negeri.</span>
                    </h2>
                    <p class="text-lg font-light leading-relaxed text-white/80">
                        Platform resmi pengaduan dan penilaian kepuasan masyarakat untuk pelayanan administrasi
                        kependudukan yang lebih baik, transparan, dan akuntabel.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-6 pt-6 border-t border-white/20">
                    <div class="flex items-start gap-3">
                        <div class="p-2 rounded bg-white/10 backdrop-blur-sm">
                            <span class="text-yellow-400 material-symbols-outlined">verified_user</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold">Aman &amp; Terpercaya</h4>
                            <p class="mt-1 text-xs text-slate-300">Data Anda dilindungi enkripsi standar pemerintah.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="p-2 rounded bg-white/10 backdrop-blur-sm">
                            <span class="text-yellow-400 material-symbols-outlined">support_agent</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold">Respon Cepat</h4>
                            <p class="mt-1 text-xs text-slate-300">Layanan pengaduan ditanggapi dengan segera.</p>
                        </div>
                    </div>
                </div>

                <!-- Footer/Copyright -->
                <div class="pt-6 text-sm text-white/40">
                    © 2024 Pemerintah Kota Bandar Lampung.
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = 'visibility';
            }
        }
    </script>
</body>

</html>
