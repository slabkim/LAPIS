<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Beranda Layanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Card 1: Pengaduan Pungli & Calo -->
                <a href="{{ route('pengaduan.pungli') }}"
                    class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 border-t-4 border-red-600">
                    <div class="text-center">
                        <div class="mb-4 text-red-600">
                            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Pengaduan Pungli & Calo</h3>
                        <p class="text-gray-600 dark:text-gray-400">Laporkan dugaan pungutan liar dan praktik percaloan.
                        </p>
                    </div>
                </a>

                <!-- Card 2: Pengaduan Keterlambatan -->
                <a href="{{ route('pengaduan.keterlambatan') }}"
                    class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 border-t-4 border-blue-600">
                    <div class="text-center">
                        <div class="mb-4 text-blue-600">
                            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Pengaduan Keterlambatan</h3>
                        <p class="text-gray-600 dark:text-gray-400">Laporkan jika pelayanan berkas Anda melebihi tenggat
                            waktu.</p>
                    </div>
                </a>

                <!-- Card 3: Survei Kepuasan -->
                <a href="{{ route('survei.index') }}"
                    class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 border-t-4 border-green-500">
                    <div class="text-center">
                        <div class="mb-4 text-green-500">
                            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Survei Kepuasan</h3>
                        <p class="text-gray-600 dark:text-gray-400">Berikan penilaian Anda terhadap pelayanan kami.</p>
                    </div>
                </a>

            </div>

            <!-- User History Section -->
            <div class="mt-12">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Riwayat Pengaduan Saya</h3>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if ($pungli->isEmpty() && $keterlambatan->isEmpty())
                            <p class="text-gray-500 text-center py-4">Belum ada riwayat pengaduan.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full leading-normal">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                                Jenis Pengaduan
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                                Layanan
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                                Tanggal
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pungli as $p)
                                            <tr>
                                                <td
                                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                                    <span class="text-red-600 font-bold">Pungli & Calo</span>
                                                </td>
                                                <td
                                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                                    {{ $p->layanan->nama_layanan }}
                                                </td>
                                                <td
                                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                                    {{ $p->created_at->format('d/m/Y') }}
                                                </td>
                                                <td
                                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        {{ $p->status_pengaduan }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach

                                        @foreach ($keterlambatan as $k)
                                            <tr>
                                                <td
                                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                                    <span class="text-blue-600 font-bold">Keterlambatan</span>
                                                </td>
                                                <td
                                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                                    {{ $k->layanan->nama_layanan }}
                                                </td>
                                                <td
                                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                                    {{ $k->created_at->format('d/m/Y') }}
                                                </td>
                                                <td
                                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        {{ $k->status_pengaduan }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
