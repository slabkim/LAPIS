<!-- Tapis Decorative Header -->
<div class="tapis-strip"></div>
<div class="p-6 flex items-center gap-3 border-b border-slate-100 dark:border-slate-800">
    <div class="bg-cover bg-center rounded-lg h-10 w-10 shrink-0 shadow-sm border border-slate-200"
        style="background-image: url('{{ asset('assets/images/Logo_balam.png') }}');">
    </div>
    <div class="flex flex-col">
        <h1 class="text-slate-900 dark:text-white text-lg font-bold leading-none tracking-tight">LAPIS Admin</h1>
        <p class="text-slate-500 dark:text-slate-400 text-[11px] font-medium mt-1">Disdukcapil B. Lampung</p>
    </div>
</div>

<div class="flex flex-col flex-1 gap-1 p-4 overflow-y-auto">
    <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-2">Menu Utama</p>

    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary/10 text-primary' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary' }} group transition-colors"
        href="{{ route('admin.dashboard') }}">
        <span class="material-symbols-outlined text-[22px]">dashboard</span>
        <span class="text-sm font-semibold">Dashboard</span>
    </a>

    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.pengaduan.pungli.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary' }} group transition-colors"
        href="{{ route('admin.pengaduan.pungli.index') }}">
        <span
            class="material-symbols-outlined text-[22px] {{ request()->routeIs('admin.pengaduan.pungli.*') ? '' : 'group-hover:text-primary' }} transition-colors">gavel</span>
        <span class="text-sm font-medium">Pengaduan Pungli & Calo</span>
    </a>

    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.pengaduan.keterlambatan.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary' }} group transition-colors"
        href="{{ route('admin.pengaduan.keterlambatan.index') }}">
        <span
            class="material-symbols-outlined text-[22px] {{ request()->routeIs('admin.pengaduan.keterlambatan.*') ? '' : 'group-hover:text-primary' }} transition-colors">schedule_send</span>
        <span class="text-sm font-medium">Pengaduan Keterlambatan</span>
    </a>

    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.survei.index') ? 'bg-primary/10 text-primary' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary' }} group transition-colors"
        href="{{ route('admin.survei.index') }}">
        <span
            class="material-symbols-outlined text-[22px] {{ request()->routeIs('admin.survei.index') ? '' : 'group-hover:text-primary' }} transition-colors">poll</span>
        <span class="text-sm font-medium">Survei Kepuasan</span>
    </a>

    <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-6">Sistem</p>

    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.master.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary' }} group transition-colors"
        href="{{ route('admin.master.jenis_layanan.index') }}">
        <span
            class="material-symbols-outlined text-[22px] {{ request()->routeIs('admin.master.*') ? '' : 'group-hover:text-primary' }} transition-colors">settings</span>
        <span class="text-sm font-medium">Pengaturan</span>
    </a>
</div>

<div class="p-4 border-t border-slate-100 dark:border-slate-800">
    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit"
            class="flex w-full items-center justify-center gap-2 rounded-lg h-10 px-4 bg-white border border-slate-200 text-lapis-red hover:bg-red-50 text-sm font-bold shadow-sm transition-all">
            <span class="material-symbols-outlined text-lg">logout</span>
            <span>Keluar</span>
        </button>
    </form>
</div>
