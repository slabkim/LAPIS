<x-admin-layout>
    <x-slot name="header">
        {{ __('Manajemen Survei Kepuasan Masyarakat') }}
    </x-slot>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 text-center">
            <h4 class="text-sm font-bold text-gray-500 uppercase">Total Responden</h4>
            <p class="text-3xl font-bold text-gray-800 dark:text-gray-200 mt-2">{{ $averages['count'] }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 text-center">
            <h4 class="text-sm font-bold text-gray-500 uppercase">Informasi</h4>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ number_format($averages['informasi'], 2) }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 text-center">
            <h4 class="text-sm font-bold text-gray-500 uppercase">Kecepatan</h4>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ number_format($averages['kecepatan'], 2) }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 text-center">
            <h4 class="text-sm font-bold text-gray-500 uppercase">Sikap</h4>
            <p class="text-3xl font-bold text-purple-600 mt-2">{{ number_format($averages['sikap'], 2) }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 text-center">
            <h4 class="text-sm font-bold text-gray-500 uppercase">IKM Total</h4>
            <p class="text-3xl font-bold text-yellow-600 mt-2">{{ number_format($averages['total'], 2) }}</p>
        </div>
    </div>

    <!-- Table -->
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
                                Layanan
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Info
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Cepat
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Sikap
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Prosedur
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider w-1/3">
                                Komentar
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($survei as $s)
                            <tr>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                    <p class="text-gray-900 dark:text-gray-300 whitespace-no-wrap">
                                        {{ $s->created_at->format('d/m/Y H:i') }}
                                    </p>
                                </td>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                    <p class="text-gray-900 dark:text-gray-300 whitespace-no-wrap">
                                        {{ $s->layanan->nama_layanan }}
                                    </p>
                                </td>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-center font-bold">
                                    {{ $s->nilai_informasi }}
                                </td>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-center font-bold">
                                    {{ $s->nilai_kecepatan }}
                                </td>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-center font-bold">
                                    {{ $s->nilai_sikap }}
                                </td>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-center font-bold">
                                    {{ $s->nilai_prosedur }}
                                </td>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm italic text-gray-500">
                                    "{{ $s->komentar ?? '-' }}"
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7"
                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-center">
                                    Belum ada data survei.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div
                    class="px-5 py-5 bg-white dark:bg-gray-800 border-t flex flex-col xs:flex-row items-center xs:justify-between">
                    {{ $survei->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
