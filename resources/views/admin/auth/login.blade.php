<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - LAPIS Disdukcapil Bandar Lampung</title>
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
            <div class="flex items-center gap-3 px-8 py-6">
                <img src="{{ asset('assets/images/Logo_balam.png') }}" alt="Logo Bandar Lampung"
                    class="size-10 object-contain">
                <div>
                    <h1 class="text-xl font-bold text-gray-900 leading-none">LAPIS Admin</h1>
                    <p class="text-xs text-gray-500 font-medium">Disdukcapil Bandar Lampung</p>
                </div>
            </div>

            <!-- Scrollable Form Content -->
            <div class="flex-1 overflow-y-auto px-8 py-4 flex flex-col justify-center items-center">
                <div class="w-full max-w-md space-y-8">
                    <!-- Welcome Text -->
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Portal Administrator</h2>
                        <p class="text-gray-500 text-base">
                            Silakan masuk dengan akun administrator untuk mengelola sistem LAPIS.
                        </p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 font-medium text-sm text-red-600 bg-red-50 p-3 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form Inputs -->
                    <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
                        @csrf

                        <!-- Email Field -->
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-900" for="email">Email
                                Administrator</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">mail</span>
                                <input
                                    class="w-full h-12 rounded-lg border-gray-200 bg-gray-50 pl-11 pr-4 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all placeholder:text-gray-400"
                                    id="email" name="email" placeholder="admin@lapis.com" type="email"
                                    value="{{ old('email') }}" required autofocus />
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-900" for="password">Password</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">lock</span>
                                <input
                                    class="w-full h-12 rounded-lg border-gray-200 bg-gray-50 pl-11 pr-12 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all placeholder:text-gray-400"
                                    id="password" name="password" placeholder="Masukkan password" type="password"
                                    required />
                                <button
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                    type="button" onclick="togglePassword()">
                                    <span class="material-symbols-outlined text-[20px]"
                                        id="toggleIcon">visibility</span>
                                </button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full h-12 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-lg shadow-red-500/30 transition-all flex items-center justify-center gap-2 group">
                            <span>Masuk ke Dashboard</span>
                            <span
                                class="material-symbols-outlined text-sm transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </button>
                    </form>

                    <!-- Security Notice -->
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 flex items-start gap-3">
                        <span class="material-symbols-outlined text-yellow-600 flex-shrink-0">info</span>
                        <div class="text-sm text-yellow-800">
                            <p class="font-semibold mb-1">Portal Khusus Administrator</p>
                            <p>Akses hanya untuk petugas yang berwenang. Semua aktivitas dicatat dalam sistem log.</p>
                        </div>
                    </div>

                    <!-- Back to Public Site -->
                    <div class="text-center pt-2">
                        <p class="text-gray-600 text-sm">
                            Bukan admin?
                            <a class="font-bold text-blue-600 hover:text-blue-700 hover:underline"
                                href="{{ route('login') }}">Masuk sebagai pengguna</a>
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
        <div class="hidden lg:flex w-1/2 h-full relative bg-gray-900 overflow-hidden group">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 z-0">
                <img class="w-full h-full object-cover opacity-60 scale-105 group-hover:scale-110 transition-transform duration-[20s] ease-in-out"
                    src="{{ asset('assets/images/Background_LAPIS.png') }}" alt="Background LAPIS" />
                <!-- Red/Dark Gradient Overlay for Admin Theme -->
                <div
                    class="absolute inset-0 bg-gradient-to-br from-red-900/90 via-gray-900/70 to-gray-900/90 mix-blend-multiply">
                </div>
            </div>

            <!-- Content Overlay on Image -->
            <div class="relative z-10 w-full h-full flex flex-col justify-end p-12 text-white">
                <div class="max-w-lg mb-8">
                    <div class="w-16 h-1 bg-gradient-to-r from-red-500 to-transparent mb-6"></div>
                    <h2 class="text-4xl font-bold leading-tight mb-4 drop-shadow-lg">
                        Sistem Manajemen<br />
                        <span class="text-red-400">LAPIS</span>
                    </h2>
                    <p class="text-lg text-gray-200 font-light leading-relaxed drop-shadow-md">
                        Dashboard administrator untuk mengelola pengaduan masyarakat, survei kepuasan, dan data master
                        layanan secara efisien dan terstruktur.
                    </p>
                </div>

                <!-- Decorative Feature List -->
                <div class="grid grid-cols-2 gap-6 pt-6 border-t border-white/20">
                    <div class="flex items-start gap-3">
                        <div class="p-2 rounded bg-white/10 backdrop-blur-sm">
                            <span class="material-symbols-outlined text-red-400">shield</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm">Keamanan Tinggi</h4>
                            <p class="text-xs text-gray-300 mt-1">Akses terenkripsi dengan log audit lengkap.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="p-2 rounded bg-white/10 backdrop-blur-sm">
                            <span class="material-symbols-outlined text-red-400">analytics</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm">Dashboard Analytics</h4>
                            <p class="text-xs text-gray-300 mt-1">Pantau statistik dan laporan real-time.</p>
                        </div>
                    </div>
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
