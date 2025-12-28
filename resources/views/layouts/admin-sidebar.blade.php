<aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-100 dark:border-gray-700 min-h-screen">
    <div class="p-6">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
            <img src="{{ asset('assets/images/Logo_balam.png') }}" alt="Logo Bandar Lampung" class="h-10 w-auto">
            <div>
                <h1 class="text-lg font-bold text-gray-800 dark:text-gray-200 leading-none">LAPIS Admin</h1>
                <p class="text-[10px] text-gray-500 dark:text-gray-400">Disdukcapil Bandar Lampung</p>
            </div>
        </a>
    </div>
    <nav class="mt-6">
        <a href="{{ route('admin.dashboard') }}"
            class="block px-6 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 dark:bg-gray-700 font-semibold' : '' }}">
            Dashboard
        </a>
        <a href="{{ route('admin.pengaduan.pungli.index') }}"
            class="block px-6 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('admin.pengaduan.pungli.*') ? 'bg-gray-100 dark:bg-gray-700 font-semibold' : '' }}">
            Pengaduan Pungli
        </a>
        <a href="{{ route('admin.pengaduan.keterlambatan.index') }}"
            class="block px-6 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('admin.pengaduan.keterlambatan.*') ? 'bg-gray-100 dark:bg-gray-700 font-semibold' : '' }}">
            Pengaduan Keterlambatan
        </a>
        <a href="{{ route('admin.survei.index') }}"
            class="block px-6 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('admin.survei.index') ? 'bg-gray-100 dark:bg-gray-700 font-semibold' : '' }}">
            Survei Kepuasan
        </a>
        <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>
        <a href="{{ route('admin.master.jenis_layanan.index') }}"
            class="block px-6 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('admin.master.jenis_layanan.*') ? 'bg-gray-100 dark:bg-gray-700 font-semibold' : '' }}">
            Master Layanan
        </a>
    </nav>
</aside>
