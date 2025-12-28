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
    <div class="flex h-full w-full">
        <!-- Left Side: Login Form -->
        <div class="w-full lg:w-1/2 flex flex-col h-full bg-white relative z-10 shadow-2xl">
            <!-- Header Logo Area -->
            <div class="flex items-center gap-3 px-8 py-8 pt-12 pl-11">
                <div
                    class="h-12 w-12 rounded-lg bg-black/10 backdrop-blur-sm flex items-center justify-center border border-black/20">
                    <img src="{{ asset('assets/images/Logo_balam.png') }}" alt="Logo Bandar Lampung"
                        class="size-10 object-contain">
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight leading-none">LAPIS</h1>
                    <p class="text-xs text-gray-500 font-medium tracking-wider uppercase">Disdukcapil Bandar Lampung</p>
                </div>
            </div>


            <!-- Scrollable Form Content -->
            <div class="flex-1 overflow-y-auto px-8 py-4 flex flex-col justify-center items-center">
                <div class="w-full max-w-md space-y-8">
                    <!-- Welcome Text -->
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Selamat Datang</h2>
                        <p class="text-gray-500 text-base">
                            Silakan masuk untuk mengakses layanan pengaduan dan penilaian pelayanan publik.
                        </p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
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
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">mail</span>
                                <input
                                    class="w-full h-12 rounded-lg border-gray-200 bg-gray-50 pl-11 pr-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-gray-400"
                                    id="email" name="email" placeholder="nama@email.com" type="email"
                                    value="{{ old('email') }}" required autofocus autocomplete="username" />
                            </div>
                            @error('email')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
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
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">lock</span>
                                <input
                                    class="w-full h-12 rounded-lg border-gray-200 bg-gray-50 pl-11 pr-12 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-gray-400"
                                    id="password" name="password" placeholder="Masukkan password" type="password"
                                    required autocomplete="current-password" />
                                <button
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                    type="button" onclick="togglePassword()">
                                    <span class="material-symbols-outlined text-[20px]"
                                        id="toggleIcon">visibility</span>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label for="remember_me" class="ml-2 text-sm text-gray-600">Ingat saya</label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full h-12 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-lg shadow-blue-500/30 transition-all flex items-center justify-center gap-2 group">
                            <span>Masuk</span>
                            <span
                                class="material-symbols-outlined text-sm transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="relative py-2">
                        <div class="absolute inset-0 flex items-center">
                            <span class="w-full border-t border-gray-200"></span>
                        </div>
                        <div class="relative flex justify-center text-xs uppercase">
                            <span class="bg-white px-2 text-gray-500">Atau masuk dengan</span>
                        </div>
                    </div>

                    <!-- Google Login Button -->
                    <a href="{{ route('auth.google') }}"
                        class="w-full h-12 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-medium rounded-lg transition-all flex items-center justify-center gap-3">
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
                    <div class="text-center pt-2">
                        <p class="text-gray-600 text-sm">
                            Belum punya akun?
                            <a class="font-bold text-blue-600 hover:text-blue-700 hover:underline"
                                href="{{ route('register') }}">Daftar sekarang</a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Footer Small Print -->
            <div class="px-8 py-4 text-center">
                <p class="text-xs text-gray-400">© 2024 Disdukcapil Kota Bandar Lampung. All rights reserved.</p>
            </div>
        </div>

        <!-- Right Side: Decorative Image / Illustration -->
        <div
            class="hidden lg:flex w-1/2 relative flex-col justify-between overflow-hidden bg-slate-900 text-white p-12">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-gradient-to-b from-blue-900/90 to-slate-900/95 z-10 mix-blend-multiply">
                </div>
                <div class="h-full w-full bg-cover bg-center opacity-60"
                    style="background-image: url('{{ asset('assets/images/Background_LAPIS.png') }}');"></div>
            </div>

            <!-- Content on top of background -->
            <div class="relative z-20 flex flex-col h-full justify-between">

                <!-- Welcome Text -->
                <div class="mb-12 my-auto py-60">
                    <div class="w-16 h-1 bg-red-600 mb-6"></div>
                    <h2 class="text-4xl font-bold leading-tight mb-4 tracking-tight">
                        Melayani Sepenuh Hati,<br />
                        <span class="text-yellow-400">Membangun Negeri.</span>
                    </h2>
                    <p class="text-lg text-white/80 leading-relaxed font-light">
                        Platform resmi pengaduan dan penilaian kepuasan masyarakat untuk pelayanan administrasi
                        kependudukan yang lebih baik, transparan, dan akuntabel.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-6 pt-6 border-t border-white/20">
                    <div class="flex items-start gap-3">
                        <div class="p-2 rounded bg-white/10 backdrop-blur-sm">
                            <span class="material-symbols-outlined text-yellow-400">verified_user</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm">Aman &amp; Terpercaya</h4>
                            <p class="text-xs text-slate-300 mt-1">Data Anda dilindungi enkripsi standar pemerintah.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="p-2 rounded bg-white/10 backdrop-blur-sm">
                            <span class="material-symbols-outlined text-yellow-400">support_agent</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm">Respon Cepat</h4>
                            <p class="text-xs text-slate-300 mt-1">Layanan pengaduan ditanggapi dengan segera.</p>
                        </div>
                    </div>
                </div>

                <!-- Footer/Copyright -->
                <div class="text-sm text-white/40 pt-6">
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
