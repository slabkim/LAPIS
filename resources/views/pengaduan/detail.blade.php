<x-user-layout>
    <x-slot name="title">Detail Pengaduan - LAPIS</x-slot>

    <main class="relative z-10 flex flex-1 flex-col items-center p-4 sm:p-6 lg:p-10 min-h-screen">
        <div class="w-full max-w-5xl">
            <!-- Header -->
            <div class="mb-6">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-blue-600 transition-colors mb-4">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    <span>Kembali ke Dashboard</span>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Detail Pengaduan</h1>
                <p class="text-gray-600 mt-1">Informasi lengkap tentang pengaduan Anda</p>
            </div>

            <!-- Main Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <!-- Status Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-6 text-white">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <p class="text-blue-100 text-sm font-medium mb-1">
                                {{ $type === 'pungli' ? 'Pengaduan Pungli & Calo' : 'Pengaduan Keterlambatan Berkas' }}
                            </p>
                            <h2 class="text-2xl font-bold">
                                #{{ str_pad($pengaduan->id_pengaduan, 4, '0', STR_PAD_LEFT) }}</h2>
                        </div>
                        <div>
                            @php
                                $statusColors = [
                                    'Menunggu Konfirmasi' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                                    'Diproses' => 'bg-blue-100 text-blue-800 border-blue-300',
                                    'Selesai' => 'bg-green-100 text-green-800 border-green-300',
                                    'Ditolak' => 'bg-red-100 text-red-800 border-red-300',
                                ];
                                $color =
                                    $statusColors[$pengaduan->status_pengaduan] ??
                                    'bg-gray-100 text-gray-800 border-gray-300';
                            @endphp
                            <span
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-bold border-2 {{ $color }}">
                                <span class="size-2 rounded-full bg-current"></span>
                                {{ $pengaduan->status_pengaduan }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Timeline Progress -->
                <div class="p-6 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-sm font-semibold text-gray-700 mb-4">Timeline Progress</h3>
                    <div class="relative">
                        <div class="flex items-center justify-between">
                            @php
                                $steps = ['Menunggu Konfirmasi', 'Diproses', 'Selesai'];
                                $currentIndex = array_search($pengaduan->status_pengaduan, $steps);
                                if ($currentIndex === false) {
                                    $currentIndex = -1;
                                }
                            @endphp

                            @foreach ($steps as $index => $step)
                                <div class="flex flex-col items-center flex-1 relative">
                                    <!-- Circle -->
                                    <div
                                        class="size-10 rounded-full flex items-center justify-center border-4 transition-all
                                        {{ $index <= $currentIndex ? 'bg-blue-600 border-blue-600 text-white' : 'bg-white border-gray-300 text-gray-400' }}">
                                        @if ($index < $currentIndex)
                                            <span class="material-symbols-outlined text-sm">check</span>
                                        @else
                                            <span class="font-bold text-sm">{{ $index + 1 }}</span>
                                        @endif
                                    </div>
                                    <!-- Label -->
                                    <p
                                        class="text-xs font-medium mt-2 text-center {{ $index <= $currentIndex ? 'text-blue-600' : 'text-gray-500' }}">
                                        {{ $step }}
                                    </p>

                                    <!-- Connector Line -->
                                    @if ($index < count($steps) - 1)
                                        <div class="absolute top-5 left-1/2 w-full h-1 -translate-y-1/2 {{ $index < $currentIndex ? 'bg-blue-600' : 'bg-gray-300' }}"
                                            style="z-index: -1;"></div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Detail Content -->
                <div class="p-6 space-y-6">
                    <!-- Basic Info -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Pengaduan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-gray-400">category</span>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Jenis Layanan</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $pengaduan->layanan->nama_layanan }}</p>
                                </div>
                            </div>

                            @if ($type === 'pungli')
                                <div class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-gray-400">calendar_today</span>
                                    <div>
                                        <p class="text-xs text-gray-500 font-medium">Tanggal Kejadian</p>
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ \Carbon\Carbon::parse($pengaduan->tanggal_kejadian)->format('d F Y') }}
                                        </p>
                                    </div>
                                </div>

                                @if ($pengaduan->nominal)
                                    <div class="flex items-start gap-3">
                                        <span class="material-symbols-outlined text-gray-400">payments</span>
                                        <div>
                                            <p class="text-xs text-gray-500 font-medium">Nominal</p>
                                            <p class="text-sm font-semibold text-gray-900">Rp
                                                {{ number_format($pengaduan->nominal, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-gray-400">schedule</span>
                                    <div>
                                        <p class="text-xs text-gray-500 font-medium">Tenggat Berkas</p>
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ \Carbon\Carbon::parse($pengaduan->tenggat_berkas)->format('d F Y') }}
                                        </p>
                                    </div>
                                </div>
                            @endif

                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-gray-400">event</span>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Tanggal Lapor</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $pengaduan->created_at->format('d F Y, H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($type === 'pungli' && $pengaduan->kronologi)
                        <!-- Kronologi -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">Kronologi Kejadian</h3>
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                                    {{ $pengaduan->kronologi }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Admin Tanggapan -->
                    @if ($pengaduan->tanggapan_admin)
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-blue-600">chat</span>
                                Tanggapan Admin
                            </h3>
                            <div class="bg-blue-50 rounded-lg p-4 border-l-4 border-blue-600">
                                <p class="text-sm text-gray-800 leading-relaxed">{{ $pengaduan->tanggapan_admin }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Lampiran -->
                    @if ($pengaduan->lampiran && $pengaduan->lampiran->count() > 0)
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">Lampiran Bukti
                                ({{ $pengaduan->lampiran->count() }} file)</h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach ($pengaduan->lampiran as $file)
                                    <a href="{{ $file->path_file }}" target="_blank"
                                        class="group relative aspect-square rounded-lg overflow-hidden border-2 border-gray-200 hover:border-blue-500 transition-all">
                                        @if ($file->tipe_file === 'foto')
                                            <img src="{{ $file->path_file }}" alt="Bukti"
                                                class="w-full h-full object-cover">
                                        @elseif($file->tipe_file === 'video')
                                            <div class="w-full h-full bg-gray-900 flex items-center justify-center">
                                                <span
                                                    class="material-symbols-outlined text-white text-4xl">play_circle</span>
                                            </div>
                                        @else
                                            <div class="w-full h-full bg-red-50 flex items-center justify-center">
                                                <span
                                                    class="material-symbols-outlined text-red-600 text-4xl">picture_as_pdf</span>
                                            </div>
                                        @endif
                                        <div
                                            class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all flex items-center justify-center">
                                            <span
                                                class="material-symbols-outlined text-white opacity-0 group-hover:opacity-100 transition-opacity">open_in_new</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</x-user-layout>
