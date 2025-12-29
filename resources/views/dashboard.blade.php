<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPIS Disdukcapil - Dashboard Pengguna</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Public Sans', sans-serif;
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
            /* Add small delay before hiding to prevent flickering */
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
                        <h1 class="text-lg font-bold leading-tight tracking-tight text-gray-900">LAPIS
                        </h1>
                        <span class="text-[10px] font-medium text-gray-500 uppercase tracking-wider">Disdukcapil Bandar
                            Lampung</span>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <nav class="flex items-center gap-6">
                        <a class="text-blue-600 font-bold text-sm" href="{{ route('dashboard') }}">Beranda</a>

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

                        <a class="text-gray-600 hover:text-blue-600 font-medium text-sm transition-colors"
                            href="{{ route('survei.index') }}">Survei</a>
                        <a class="text-gray-600 hover:text-blue-600 font-medium text-sm transition-colors"
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
                <button class="md:hidden p-2 text-gray-600" onclick="toggleMobileMenu()">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-10">

        <!-- Hero Section -->
        <div class="relative w-full rounded-2xl overflow-hidden shadow-lg group">
            <!-- Background with gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-blue-700"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

            <div class="relative px-6 py-12 md:px-12 md:py-16 flex flex-col justify-end min-h-[320px] text-white">
                <div class="max-w-2xl space-y-4">
                    <span
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 text-xs font-semibold tracking-wide uppercase">
                        <span class="material-symbols-outlined text-sm">waving_hand</span>
                        Selamat Datang, {{ Auth::user()->name }}
                    </span>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight">
                        Laporan & Penilaian Indeks Survei Kepuasan
                    </h1>
                    <p class="text-base md:text-lg text-gray-100 font-medium opacity-90 leading-relaxed max-w-xl">
                        Disdukcapil Kota Bandar Lampung berkomitmen memberikan pelayanan terbaik. Laporkan kendala atau
                        berikan penilaian Anda di sini.
                    </p>
                    {{-- 
                    <div class="pt-4 flex flex-wrap gap-4">
                        <button class="flex items-center gap-2 bg-white text-blue-600 hover:bg-gray-50 font-bold py-3 px-6 rounded-lg transition-all shadow-md">
                            <span class="material-symbols-outlined">article</span>
                            Panduan Layanan
                        </button>
                    </div>
                    --}}
                </div>
            </div>
        </div>

        <!-- Main Services Grid -->
        <section>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <span class="w-1 h-6 bg-red-600 rounded-full"></span>
                    Layanan Utama
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Card 1: Pungli (Warning Theme) -->
                <div
                    class="group relative bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300 flex flex-col">
                    <div
                        class="h-40 w-full bg-gradient-to-br from-red-50 to-red-100 relative flex items-center justify-center">
                        <div
                            class="size-16 bg-white rounded-lg shadow-sm flex items-center justify-center text-red-600">
                            <span class="material-symbols-outlined text-4xl">gavel</span>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-red-600 transition-colors">
                            Pengaduan Pungli & Calo
                        </h3>
                        <p class="text-gray-500 text-sm mb-6 flex-grow">
                            Laporkan indikasi pungutan liar atau praktik percaloan dalam pelayanan administrasi
                            kependudukan.
                        </p>
                        <a href="{{ route('pengaduan.pungli') }}"
                            class="w-full mt-auto flex items-center justify-center gap-2 bg-white border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white font-bold py-2.5 px-4 rounded-lg transition-all">
                            Buat Laporan
                        </a>
                    </div>
                </div>

                <!-- Card 2: Keterlambatan (Primary Blue Theme) -->
                <div
                    class="group relative bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300 flex flex-col">
                    <div
                        class="h-40 w-full bg-gradient-to-br from-blue-50 to-blue-100 relative flex items-center justify-center">
                        <div
                            class="size-16 bg-white rounded-lg shadow-sm flex items-center justify-center text-blue-600">
                            <span class="material-symbols-outlined text-4xl">schedule_send</span>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                            Keterlambatan Berkas
                        </h3>
                        <p class="text-gray-500 text-sm mb-6 flex-grow">
                            Laporkan jika dokumen kependudukan Anda tidak selesai tepat waktu sesuai Standar Operasional
                            Prosedur (SOP).
                        </p>
                        <a href="{{ route('pengaduan.keterlambatan') }}"
                            class="w-full mt-auto flex items-center justify-center gap-2 bg-white border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-bold py-2.5 px-4 rounded-lg transition-all">
                            Buat Laporan
                        </a>
                    </div>
                </div>

                <!-- Card 3: Survei (Green/Positive Theme) -->
                <div
                    class="group relative bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300 flex flex-col">
                    <div
                        class="h-40 w-full bg-gradient-to-br from-green-50 to-green-100 relative flex items-center justify-center">
                        <div
                            class="size-16 bg-white rounded-lg shadow-sm flex items-center justify-center text-green-600">
                            <span class="material-symbols-outlined text-4xl">sentiment_satisfied</span>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">
                            Survei Kepuasan
                        </h3>
                        <p class="text-gray-500 text-sm mb-6 flex-grow">
                            Bantu kami meningkatkan kualitas pelayanan dengan mengisi survei kepuasan masyarakat.
                        </p>
                        <a href="{{ route('survei.index') }}"
                            class="w-full mt-auto flex items-center justify-center gap-2 bg-green-600 text-white hover:bg-green-700 font-bold py-2.5 px-4 rounded-lg transition-all shadow-sm hover:shadow">
                            Isi Survei
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- Recent Activity Section -->
        <section class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Riwayat Laporan Terakhir</h2>
                {{-- <a href="#" class="text-sm font-semibold text-blue-600 hover:underline">Lihat Semua</a> --}}
            </div>

            @if ($pungli->isEmpty() && $keterlambatan->isEmpty())
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <div class="bg-gray-50 p-4 rounded-full mb-3">
                        <span class="material-symbols-outlined text-gray-400 text-3xl">inbox</span>
                    </div>
                    <p class="text-gray-500 font-medium">Belum ada riwayat laporan.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="py-3 px-2 text-xs font-bold uppercase text-gray-400 tracking-wider">ID
                                    Laporan</th>
                                <th class="py-3 px-2 text-xs font-bold uppercase text-gray-400 tracking-wider">Jenis
                                </th>
                                <th class="py-3 px-2 text-xs font-bold uppercase text-gray-400 tracking-wider">Tanggal
                                </th>
                                <th class="py-3 px-2 text-xs font-bold uppercase text-gray-400 tracking-wider">Status
                                </th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @foreach ($pungli->take(5) as $p)
                                <tr class="group hover:bg-gray-50 transition-colors border-b border-gray-50">
                                    <td class="py-4 px-2 font-medium text-gray-900">
                                        #LPS-{{ $p->id_pengaduan }}</td>
                                    <td class="py-4 px-2 text-gray-600">
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined text-base text-red-600">gavel</span>
                                            Pungli & Calo
                                        </div>
                                    </td>
                                    <td class="py-4 px-2 text-gray-500">{{ $p->created_at->format('d M Y') }}</td>
                                    <td class="py-4 px-2">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold 
                                            @if ($p->status_pengaduan == 'Selesai') bg-green-100 text-green-800
                                            @elseif($p->status_pengaduan == 'Diproses') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            <span
                                                class="size-1.5 rounded-full 
                                                @if ($p->status_pengaduan == 'Selesai') bg-green-500
                                                @elseif($p->status_pengaduan == 'Diproses') bg-yellow-500
                                                @else bg-gray-500 @endif"></span>
                                            {{ $p->status_pengaduan }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-2 text-right">
                                        <a href="{{ route('pengaduan.show', ['type' => 'pungli', 'id' => $p->id_pengaduan]) }}"
                                            class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                                            Detail →
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($keterlambatan->take(5) as $k)
                                <tr class="group hover:bg-gray-50 transition-colors border-b border-gray-50">
                                    <td class="py-4 px-2 font-medium text-gray-900">
                                        #LPK-{{ $k->id_pengaduan }}</td>
                                    <td class="py-4 px-2 text-gray-600">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="material-symbols-outlined text-base text-blue-600">schedule_send</span>
                                            Keterlambatan
                                        </div>
                                    </td>
                                    <td class="py-4 px-2 text-gray-500">{{ $k->created_at->format('d M Y') }}</td>
                                    <td class="py-4 px-2">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold 
                                            @if ($k->status_pengaduan == 'Selesai') bg-green-100 text-green-800
                                            @elseif($k->status_pengaduan == 'Diproses') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            <span
                                                class="size-1.5 rounded-full 
                                                @if ($k->status_pengaduan == 'Selesai') bg-green-500
                                                @elseif($k->status_pengaduan == 'Diproses') bg-yellow-500
                                                @else bg-gray-500 @endif"></span>
                                            {{ $k->status_pengaduan }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-2 text-right">
                                        <a href="{{ route('pengaduan.show', ['type' => 'keterlambatan', 'id' => $k->id_pengaduan]) }}"
                                            class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                                            Detail →
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

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
                    <h3 class="font-bold text-sm text-gray-900 mb-4 uppercase tracking-wider">Tautan
                    </h3>
                    <ul class="space-y-3">
                        <li><a class="text-sm text-gray-500 hover:text-blue-600 dark:text-gray-400"
                                href="#">Tentang Kami</a></li>
                        <li><a class="text-sm text-gray-500 hover:text-blue-600 dark:text-gray-400"
                                href="#">Kebijakan Privasi</a></li>
                        <li><a class="text-sm text-gray-500 hover:text-blue-600 dark:text-gray-400"
                                href="#">FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-sm text-gray-900 mb-4 uppercase tracking-wider">Kontak
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-gray-400 text-sm mt-0.5">location_on</span>
                            <span class="text-sm text-gray-500">Jl. Dr. Susilo No. 2, Bandar
                                Lampung</span>
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
        function toggleMobileMenu() {
            // Mobile menu handler - implement if needed
            alert('Mobile menu - to be implemented');
        }
    </script>
</body>

</html>
