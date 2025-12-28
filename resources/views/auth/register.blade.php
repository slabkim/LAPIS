<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPIS - Registrasi Pengguna Baru</title>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Public Sans', sans-serif;
        }
    </style>
</head>

<body class="font-display bg-gray-50 antialiased overflow-hidden h-full">
    <div class="flex min-h-screen w-full flex-row">
        <!-- Left Side: Visual/Branding -->
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
                <!-- Logo Area -->
                <div class="flex items-center gap-3">
                    <div
                        class="h-12 w-12 rounded-lg bg-white/10 backdrop-blur-sm flex items-center justify-center border border-white/20">
                        <img src="{{ asset('assets/images/Logo_balam.png') }}" alt="Logo Bandar Lampung"
                            class="h-10 w-10 object-contain">
                    </div>
                    <div>
                        <h1 class="font-black text-2xl tracking-tight text-white">LAPIS</h1>
                        <p class="text-xs text-white/70 font-medium tracking-wider uppercase">Disdukcapil Bandar Lampung
                        </p>
                    </div>
                </div>

                <!-- Welcome Text -->
                <div class="mb-12 my-auto py-60 ">
                    <div class="w-16 h-1 bg-red-600 mb-6"></div>
                    <h2 class="text-4xl font-bold leading-tight mb-4 tracking-tight">Layanan Pengaduan & Penilaian
                        Kepuasan Masyarakat</h2>
                    <p class="text-lg text-white/80 leading-relaxed font-light">
                        Wujudkan pelayanan publik yang lebih baik, transparan, dan akuntabel di Kota Bandar Lampung
                        bersama kami.
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

        <!-- Right Side: Registration Form -->
        <div class="flex-1 flex flex-col h-screen overflow-y-auto bg-white bg-white">
            <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-20 xl:px-24">
                <div class="mx-auto w-full max-w-sm lg:w-96">
                    <!-- Mobile Logo (Visible only on small screens) -->
                    <div class="lg:hidden flex items-center gap-2 mb-8">
                        <img src="{{ asset('assets/images/Logo_balam.png') }}" alt="Logo Bandar Lampung"
                            class="h-8 w-8 object-contain">
                        <span class="font-bold text-xl text-slate-900 dark:text-white">LAPIS</span>
                    </div>

                    <!-- Header -->
                    <div class="mb-8">
                        <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Buat Akun Baru
                        </h2>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">
                            Silakan lengkapi data diri Anda untuk memulai.
                        </p>
                    </div>

                    <!-- Form -->
                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <!-- Name Field -->
                        <div>
                            <label class="text-sm font-semibold text-gray-900" for="name">
                                Nama Lengkap
                            </label>
                            <div class="mt-2">
                                <input autocomplete="name"
                                    class="block w-full rounded-lg border-gray-200 py-3 pl-3 pr-10 text-slate-900 shadow-sm ring-1 ring-slate-300 placeholder:text-gray-400 focus:ring-2 focus:ring-2 focus:ring-blue-500 sm:text-sm sm:leading-6 bg-gray-50"
                                    id="name" name="name" placeholder="Contoh: Budi Santoso" required
                                    type="text" value="{{ old('name') }}" autofocus />
                            </div>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label class="text-sm font-semibold text-gray-900" for="email">
                                Alamat Email
                            </label>
                            <div class="mt-2 relative">
                                <input autocomplete="email"
                                    class="block w-full rounded-lg border-gray-200 py-3 pl-3 pr-10 text-slate-900 shadow-sm ring-1 ring-slate-300 placeholder:text-gray-400 focus:ring-2 focus:ring-2 focus:ring-blue-500 sm:text-sm sm:leading-6 bg-gray-50"
                                    id="email" name="email" placeholder="contoh@email.com" required type="email"
                                    value="{{ old('email') }}" />
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400">
                                    <span class="material-symbols-outlined text-[20px]">mail</span>
                                </div>
                            </div>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label class="text-sm font-semibold text-gray-900" for="password">
                                Kata Sandi
                            </label>
                            <div class="mt-2 relative rounded-lg shadow-sm">
                                <input autocomplete="new-password"
                                    class="block w-full rounded-lg border-gray-200 py-3 pl-3 pr-10 text-slate-900 shadow-sm ring-1 ring-slate-300 placeholder:text-gray-400 focus:ring-2 focus:ring-2 focus:ring-blue-500 sm:text-sm sm:leading-6 bg-gray-50"
                                    id="password" name="password" placeholder="Minimal 8 karakter" required
                                    type="password" />
                                <button
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-slate-400 hover:text-slate-600 dark:hover:text-slate-300"
                                    type="button" onclick="togglePassword('password')">
                                    <span class="material-symbols-outlined text-[20px]"
                                        id="password-icon">visibility</span>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div>
                            <label class="text-sm font-semibold text-gray-900" for="password_confirmation">
                                Konfirmasi Kata Sandi
                            </label>
                            <div class="mt-2 relative rounded-lg shadow-sm">
                                <input
                                    class="block w-full rounded-lg border-gray-200 py-3 pl-3 pr-10 text-slate-900 shadow-sm ring-1 ring-slate-300 placeholder:text-gray-400 focus:ring-2 focus:ring-2 focus:ring-blue-500 sm:text-sm sm:leading-6 bg-gray-50"
                                    id="password_confirmation" name="password_confirmation"
                                    placeholder="Ulangi kata sandi" required type="password" />
                                <button
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-slate-400 hover:text-slate-600 dark:hover:text-slate-300"
                                    type="button" onclick="togglePassword('password_confirmation')">
                                    <span class="material-symbols-outlined text-[20px]"
                                        id="password_confirmation-icon">visibility</span>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button
                                class="flex w-full justify-center rounded-lg bg-blue-600 px-3 py-3 text-sm font-bold leading-6 text-white shadow-sm hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors duration-200"
                                type="submit">
                                Daftar Sekarang
                            </button>
                        </div>
                    </form>

                    <!-- Divider -->
                    <div class="mt-8">
                        <div class="relative">
                            <div aria-hidden="true" class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center text-xs uppercase">
                                <span class="bg-white px-2 text-gray-500">atau
                                    daftar dengan</span>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-1 gap-4">
                            <a class="w-full h-12 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-medium rounded-lg transition-all flex items-center justify-center gap-3"
                                href="{{ route('auth.google') }}">
                                <svg class="h-5 w-5" viewBox="0 0 24 24">
                                    <path fill="#4285F4"
                                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                    <path fill="#34A853"
                                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                    <path fill="#FBBC05"
                                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                    <path fill="#EA4335"
                                        d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                                </svg>
                                <span class="text-sm">Google</span>
                            </a>
                        </div>
                    </div>

                    <!-- Footer -->
                    <p class="mt-8 text-center text-sm text-slate-500 dark:text-slate-400">
                        Sudah punya akun?
                        <a class="font-bold leading-6 text-blue-600 hover:text-blue-700 hover:underline decoration-2 underline-offset-2 transition-all"
                            href="{{ route('login') }}">Masuk di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(fieldId + '-icon');

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
