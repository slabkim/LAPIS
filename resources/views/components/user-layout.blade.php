<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'LAPIS Disdukcapil' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Material Symbols -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Public Sans', sans-serif;
            background-image: url('{{ asset('assets/images/Background_LAPIS.png') }}');
            background-repeat: repeat;
            background-size: 300px 300px;
            /* Adjust size as needed */
            background-attachment: fixed;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.92);
            z-index: -1;
            pointer-events: none;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Dropdown hover - stays visible while cursor in dropdown area */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            display: none;
            transition: opacity 0.15s ease-in-out;
        }

        /* Create invisible bridge between button and menu to prevent hover gap */
        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -0.5rem;
            left: 0;
            right: 0;
            height: 0.5rem;
        }

        .dropdown:hover .dropdown-menu,
        .dropdown-menu:hover {
            display: block;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col">

    <!-- Navigation Bar -->
    <header class="sticky top-0 z-50 bg-white backdrop-blur-md border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div>
                        <img src="{{ asset('assets/images/Logo_balam.png') }}" alt="Logo Bandar Lampung"
                            class="size-10 object-contain">
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-lg font-bold leading-tight tracking-tight text-gray-900">LAPIS</h1>
                        <span class="text-[10px] font-medium text-gray-500 uppercase tracking-wider">Disdukcapil Bandar
                            Lampung</span>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <nav class="flex items-center gap-6">
                        <a class="{{ request()->routeIs('dashboard') ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-blue-600 font-medium' }} text-sm transition-colors"
                            href="{{ route('dashboard') }}">Beranda</a>

                        <!-- Dropdown Pengaduan -->
                        <div class="relative dropdown">
                            <button
                                class="text-gray-600 hover:text-blue-600 font-medium text-sm transition-colors flex items-center gap-1">
                                Pengaduan
                                <span class="material-symbols-outlined text-sm">expand_more</span>
                            </button>
                            <div
                                class="dropdown-menu hidden absolute top-full left-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-2">
                                <a href="{{ route('pengaduan.pungli') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <span class="material-symbols-outlined text-red-600">gavel</span>
                                    <span>Pengaduan Calo & Pungli</span>
                                </a>
                                <a href="{{ route('pengaduan.keterlambatan') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <span class="material-symbols-outlined text-blue-600">schedule_send</span>
                                    <span>Pengaduan Berkas Terlambat</span>
                                </a>
                            </div>
                        </div>

                        <a class="{{ request()->routeIs('survei.*') ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-blue-600 font-medium' }} text-sm transition-colors"
                            href="{{ route('survei.index') }}">Survei</a>
                        <a class="{{ request()->routeIs('profile.*') ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-blue-600 font-medium' }} text-sm transition-colors"
                            href="{{ route('profile.edit') }}">Profil</a>
                    </nav>

                    <div class="h-6 w-px bg-gray-200"></div>

                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-3 pl-2">
                            <div class="text-right hidden lg:block">
                                <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">Masyarakat</p>
                            </div>
                            <div class="size-9 rounded-full bg-gray-200 bg-center bg-cover border-2 border-white shadow-sm"
                                style="background-image: url('{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}');">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2 text-gray-600" id="mobile-menu-button">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 md:hidden">
            <div id="mobile-menu"
                class="fixed top-0 right-0 h-full w-64 bg-white shadow-lg transform translate-x-full transition-transform duration-300">
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <h2 class="font-bold text-gray-900">Menu</h2>
                    <button id="mobile-menu-close" class="p-2 text-gray-600">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <nav class="flex flex-col p-4 space-y-2">
                    <a class="{{ request()->routeIs('dashboard') ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-blue-600 font-medium' }} py-2 transition-colors"
                        href="{{ route('dashboard') }}">Beranda</a>

                    <div class="border-t border-gray-200 pt-2 mt-2">
                        <p class="text-xs font-semibold text-gray-400 uppercase mb-2">Pengaduan</p>
                        <a href="{{ route('pengaduan.pungli') }}"
                            class="flex items-center gap-3 py-2 text-gray-700 hover:text-blue-600 transition-colors">
                            <span class="material-symbols-outlined text-red-600">gavel</span>
                            <span class="text-sm">Pengaduan Calo & Pungli</span>
                        </a>
                        <a href="{{ route('pengaduan.keterlambatan') }}"
                            class="flex items-center gap-3 py-2 text-gray-700 hover:text-blue-600 transition-colors">
                            <span class="material-symbols-outlined text-blue-600">schedule_send</span>
                            <span class="text-sm">Pengaduan Berkas Terlambat</span>
                        </a>
                    </div>

                    <a class="{{ request()->routeIs('survei.*') ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-blue-600 font-medium' }} py-2 transition-colors"
                        href="{{ route('survei.index') }}">Survei</a>
                    <a class="{{ request()->routeIs('profile.*') ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-blue-600 font-medium' }} py-2 transition-colors"
                        href="{{ route('profile.edit') }}">Profil</a>

                    <div class="border-t border-gray-200 pt-4 mt-4">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="size-9 rounded-full bg-gray-200 bg-center bg-cover border-2 border-white shadow-sm"
                                style="background-image: url('{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}');">
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">Masyarakat</p>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div>
                            <img src="{{ asset('assets/images/Logo_balam.png') }}" alt="Logo Bandar Lampung"
                                class="size-10 object-contain">
                        </div>
                        <span class="font-bold text-lg text-gray-900">LAPIS Disdukcapil</span>
                    </div>
                    <p class="text-sm text-gray-500 max-w-sm mb-4">
                        Sistem layanan pengaduan dan informasi terpadu untuk pelayanan administrasi kependudukan yang
                        bersih, transparan, dan akuntabel di Kota Bandar Lampung.
                    </p>
                </div>

                <div>
                    <h3 class="font-bold text-sm text-gray-900 mb-4 uppercase tracking-wider">Tautan</h3>
                    <ul class="space-y-3">
                        <li><a class="text-sm text-gray-500 hover:text-blue-600" href="#">Tentang Kami</a></li>
                        <li><a class="text-sm text-gray-500 hover:text-blue-600" href="#">Kebijakan Privasi</a>
                        </li>
                        <li><a class="text-sm text-gray-500 hover:text-blue-600" href="#">FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-sm text-gray-900 mb-4 uppercase tracking-wider">Kontak</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-gray-400 text-sm mt-0.5">location_on</span>
                            <span class="text-sm text-gray-500">Jl. Dr. Susilo No. 2, Bandar Lampung</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-gray-400 text-sm">phone</span>
                            <span class="text-sm text-gray-500">(0721) 481234</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-gray-400 text-sm">email</span>
                            <span class="text-sm text-gray-500">disdukcapil@bandarlampungkota.go.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div
                class="border-t border-gray-100 mt-10 pt-6 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm text-gray-400 text-center md:text-left">
                    © {{ date('Y') }} Dinas Kependudukan dan Pencatatan Sipil Kota Bandar Lampung.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuClose = document.getElementById('mobile-menu-close');

        function openMobileMenu() {
            mobileMenuOverlay.classList.remove('hidden');
            setTimeout(() => {
                mobileMenu.classList.remove('translate-x-full');
            }, 10);
        }

        function closeMobileMenu() {
            mobileMenu.classList.add('translate-x-full');
            setTimeout(() => {
                mobileMenuOverlay.classList.add('hidden');
            }, 300);
        }

        mobileMenuButton.addEventListener('click', openMobileMenu);
        mobileMenuClose.addEventListener('click', closeMobileMenu);
        mobileMenuOverlay.addEventListener('click', (e) => {
            if (e.target === mobileMenuOverlay) {
                closeMobileMenu();
            }
        });
    </script>
</body>

</html>
