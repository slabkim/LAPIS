<x-admin-layout>
    <x-slot name="header">
        Dashboard Overview
    </x-slot>

    <div class="max-w-7xl mx-auto flex flex-col gap-6">
        <!-- Page Title & Date -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Dashboard Overview</h1>
                <p class="text-slate-500 text-sm mt-1">Ringkasan aktivitas layanan pengaduan dan survei masyarakat.
                </p>
            </div>
            <div
                class="flex items-center gap-2 bg-white dark:bg-slate-800 px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm">
                <span class="material-symbols-outlined text-slate-400 text-[18px]">calendar_today</span>
                <span
                    class="text-sm font-medium text-slate-600 dark:text-slate-300">{{ \Carbon\Carbon::now()->isoFormat('dddd, DD MMMM YYYY') }}</span>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Card 1: Total Complaints (Blue) -->
            <div
                class="bg-white dark:bg-[#1a202c] p-5 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <span class="material-symbols-outlined text-6xl text-primary">folder_open</span>
                </div>
                <div class="flex flex-col gap-1 relative z-10">
                    <p class="text-slate-500 text-sm font-medium">Total Pengaduan</p>
                    <div class="flex items-baseline gap-2">
                        <h2 class="text-3xl font-bold text-slate-900 dark:text-white">0</h2>
                        <span
                            class="text-emerald-600 text-xs font-bold bg-emerald-50 px-1.5 py-0.5 rounded flex items-center">
                            <span class="material-symbols-outlined text-[14px]">trending_up</span> 0%
                        </span>
                    </div>
                    <p class="text-slate-400 text-xs mt-2">Masuk bulan ini</p>
                </div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-primary"></div>
            </div>

            <!-- Card 2: Pending Complaints (Red - Alert) -->
            <div
                class="bg-white dark:bg-[#1a202c] p-5 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <span class="material-symbols-outlined text-6xl text-lapis-red">pending_actions</span>
                </div>
                <div class="flex flex-col gap-1 relative z-10">
                    <p class="text-slate-500 text-sm font-medium">Pengaduan Menunggu</p>
                    <div class="flex items-baseline gap-2">
                        <h2 class="text-3xl font-bold text-slate-900 dark:text-white">0</h2>
                        <span
                            class="text-lapis-red text-xs font-bold bg-red-50 px-1.5 py-0.5 rounded flex items-center">
                            <span class="material-symbols-outlined text-[14px]">priority_high</span> 0%
                        </span>
                    </div>
                    <p class="text-slate-400 text-xs mt-2">Perlu tindak lanjut segera</p>
                </div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-lapis-red"></div>
            </div>

            <!-- Card 3: Total Surveys -->
            <div
                class="bg-white dark:bg-[#1a202c] p-5 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <span class="material-symbols-outlined text-6xl text-slate-600">assignment</span>
                </div>
                <div class="flex flex-col gap-1 relative z-10">
                    <p class="text-slate-500 text-sm font-medium">Total Survei</p>
                    <div class="flex items-baseline gap-2">
                        <h2 class="text-3xl font-bold text-slate-900 dark:text-white">0</h2>
                        <span
                            class="text-emerald-600 text-xs font-bold bg-emerald-50 px-1.5 py-0.5 rounded flex items-center">
                            <span class="material-symbols-outlined text-[14px]">trending_up</span> 0%
                        </span>
                    </div>
                    <p class="text-slate-400 text-xs mt-2">Partisipasi masyarakat</p>
                </div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-slate-600"></div>
            </div>

            <!-- Card 4: Satisfaction Index (Gold accent for Quality) -->
            <div
                class="bg-white dark:bg-[#1a202c] p-5 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <span class="material-symbols-outlined text-6xl text-lapis-gold">workspace_premium</span>
                </div>
                <div class="flex flex-col gap-1 relative z-10">
                    <p class="text-slate-500 text-sm font-medium">Indeks Kepuasan</p>
                    <div class="flex items-baseline gap-2">
                        <h2 class="text-3xl font-bold text-slate-900 dark:text-white">0.0<span
                                class="text-lg text-slate-400 font-normal">/4.00</span></h2>
                    </div>
                    <div class="flex items-center gap-1 mt-2">
                        <span class="material-symbols-outlined text-slate-300 text-[16px]">star</span>
                        <span class="material-symbols-outlined text-slate-300 text-[16px]">star</span>
                        <span class="material-symbols-outlined text-slate-300 text-[16px]">star</span>
                        <span class="material-symbols-outlined text-slate-300 text-[16px]">star</span>
                        <span class="material-symbols-outlined text-slate-300 text-[16px]">star</span>
                        <p class="text-slate-400 text-xs ml-1">Belum Ada Data</p>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-lapis-gold"></div>
            </div>
        </div>

        <!-- Info Section -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4">
            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-primary text-2xl">info</span>
                <div>
                    <h3 class="font-bold text-slate-900 dark:text-white mb-1">Selamat Datang di LAPIS Admin Panel</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400">
                        Sistem manajemen layanan pengaduan dan informasi terpadu untuk Disdukcapil Kota Bandar
                        Lampung. Gunakan menu navigasi di sebelah kiri untuk mengakses berbagai fitur administrasi.
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-4 pb-6 text-center text-xs text-slate-400">
            © {{ date('Y') }} Disdukcapil Kota Bandar Lampung. All rights reserved. <br />
            System Version 1.0.2
        </footer>
    </div>
</x-admin-layout>
