<x-admin-layout>
    <x-slot name="header">
        {{ __('Dashboard Overview') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Ringkasan Pengaduan -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Total Pengaduan</h3>
                    <p class="text-3xl font-bold text-blue-600">0</p>
                </div>

                <!-- Ringkasan Survei -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Total Survei</h3>
                    <p class="text-3xl font-bold text-green-600">0</p>
                </div>

                <!-- Kepuasan Rata-rata -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">IKM Rata-rata</h3>
                    <p class="text-3xl font-bold text-yellow-500">0.0</p>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
