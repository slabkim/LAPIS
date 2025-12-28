<x-admin-layout>
    <x-slot name="header">
        {{ __('Pengaduan Pungli & Calo') }}
    </x-slot>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Pelapor
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Layanan
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengaduan as $p)
                            <tr>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                    <p class="text-gray-900 dark:text-gray-300 whitespace-no-wrap">
                                        {{ $p->tanggal_kejadian->format('d/m/Y') }}
                                    </p>
                                </td>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                    <p class="text-gray-900 dark:text-gray-300 whitespace-no-wrap">
                                        {{ $p->is_anonim ? 'Anonim' : $p->user->name ?? 'User Deleted' }}
                                    </p>
                                </td>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                    <p class="text-gray-900 dark:text-gray-300 whitespace-no-wrap">
                                        {{ $p->layanan->nama_layanan }}
                                    </p>
                                </td>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative">{{ $p->status_pengaduan }}</span>
                                    </span>
                                </td>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                    <a href="{{ route('admin.pengaduan.pungli.show', $p->id_pengaduan) }}"
                                        class="text-blue-600 hover:text-blue-900">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-center">
                                    Tidak ada data pengaduan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div
                    class="px-5 py-5 bg-white dark:bg-gray-800 border-t flex flex-col xs:flex-row items-center xs:justify-between">
                    {{ $pengaduan->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
