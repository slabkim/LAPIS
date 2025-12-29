<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - LAPIS Disdukcapil Bandar Lampung</title>
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
        <!-- Left Side: Forgot Password Form -->
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
                    <!-- Back to Login -->
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-blue-600 transition-colors">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        <span>Kembali ke Login</span>
                    </a>

                    <!-- Page Title -->
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Lupa Password</h2>
                        <p class="text-gray-500 text-base">
                            Tidak masalah! Masukkan email Anda dan kami akan mengirimkan link reset password.
                        </p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-green-600">check_circle</span>
                                <p class="text-sm text-green-800 font-medium">
                                    {{ session('status') }}
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- Form -->
                    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                        @csrf

                        <!-- Email Field -->
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-900" for="email">Email</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">email</span>
                                <input
                                    class="w-full h-12 rounded-lg border-gray-200 bg-gray-50 pl-11 pr-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-gray-400"
                                    id="email" name="email" placeholder="nama@email.com" type="email"
                                    value="{{ old('email') }}" required autofocus autocomplete="email" />
                            </div>
                            @error('email')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full h-12 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-lg shadow-blue-500/30 transition-all flex items-center justify-center gap-2 group">
                            <span>Kirim Link Reset Password</span>
                            <span
                                class="material-symbols-outlined text-sm transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </button>
                    </form>

                    <!-- Footer / Back to Login Link -->
                    <div class="text-center pt-2">
                        <p class="text-gray-600 text-sm">
                            Sudah ingat password Anda?
                            <a class="font-bold text-blue-600 hover:text-blue-700 hover:underline"
                                href="{{ route('login') }}">Login sekarang</a>
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
                        Butuh Bantuan?<br />
                        <span class="text-yellow-400">Kami Siap Membantu.</span>
                    </h2>
                    <p class="text-lg text-white/80 leading-relaxed font-light">
                        Jangan khawatir jika lupa password. Proses reset password mudah dan aman untuk melindungi akun
                        Anda.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-6 pt-6 border-t border-white/20">
                    <div class="flex items-start gap-3">
                        <div class="p-2 rounded bg-white/10 backdrop-blur-sm">
                            <span class="material-symbols-outlined text-yellow-400">verified_user</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm">Aman & Terpercaya</h4>
                            <p class="text-xs text-slate-300 mt-1">Link reset hanya berlaku 60 menit.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="p-2 rounded bg-white/10 backdrop-blur-sm">
                            <span class="material-symbols-outlined text-yellow-400">support_agent</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm">Bantuan 24/7</h4>
                            <p class="text-xs text-slate-300 mt-1">Hubungi kami jika ada kendala.</p>
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
</body>

</html>
