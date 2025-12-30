<x-admin-layout>
    <x-slot name="header">
        {{ __('Detail Pengaduan Keterlambatan') }}
    </x-slot>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Informasi Utama -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Informasi Pengaduan</h3>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tenggat Berkas</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">
                            {{ $pengaduan->tenggat_berkas->format('d F Y') }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Layanan</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">
                            {{ $pengaduan->layanan->nama_layanan }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Informasi Pelapor & Status -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Informasi Pelapor</h3>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Pelapor</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">
                            {{ $pengaduan->user->name ?? 'User Deleted' }}
                        </dd>
                    </div>
                    @if ($pengaduan->user)
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">{{ $pengaduan->user->email }}</dd>
                        </div>
                    @endif
                    <div class="sm:col-span-2 mt-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status Pengaduan</dt>
                        <dd class="mt-1">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                {{ $pengaduan->status_pengaduan }}
                            </span>
                        </dd>
                    </div>
                    <div class="sm:col-span-2 mt-4">
                        <form
                            action="{{ route('admin.pengaduan.update-status', ['type' => 'keterlambatan', 'id' => $pengaduan->id_pengaduan]) }}"
                            method="POST" class="flex items-center space-x-2">
                            @csrf
                            @method('PATCH')
                            <select name="status_pengaduan"
                                class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="Pending"
                                    {{ $pengaduan->status_pengaduan == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Proses" {{ $pengaduan->status_pengaduan == 'Proses' ? 'selected' : '' }}>
                                    Proses</option>
                                <option value="Selesai"
                                    {{ $pengaduan->status_pengaduan == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Ditolak"
                                    {{ $pengaduan->status_pengaduan == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Status
                            </button>
                        </form>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Lampiran -->
        <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Lampiran Bukti</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @forelse($pengaduan->lampiran as $l)
                    <div class="border rounded p-2">
                        <a href="{{ str_starts_with($l->path_file, 'http') ? $l->path_file : asset('storage/' . $l->path_file) }}"
                            target="_blank" class="text-blue-500 hover:underline break-all">
                            {{ $l->tipe_file }} - Lihat File
                        </a>
                    </div>
                @empty
                    <p class="text-gray-500">Tidak ada lampiran.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>
