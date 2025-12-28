<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Survei Kepuasan Masyarakat') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ step: 1, maxStep: 6 }">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 relative min-h-[400px]">

                <!-- Progress Bar -->
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mb-6">
                    <div class="bg-blue-600 h-2.5 rounded-full" :style="'width: ' + ((step / maxStep) * 100) + '%'">
                    </div>
                </div>

                <form method="POST" action="{{ route('survei.store') }}">
                    @csrf

                    <!-- Step 1: Jenis Layanan -->
                    <div x-show="step === 1" x-transition.opacity>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4 text-center">Layanan apa
                            yang Anda terima?</h3>
                        <div class="mb-4">
                            <select id="id_layanan" name="id_layanan"
                                class="block w-full text-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-3">
                                <option value="">Pilih Layanan</option>
                                @foreach ($layanan as $l)
                                    <option value="{{ $l->id_layanan }}">{{ $l->nama_layanan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Step 2: Informasi -->
                    <div x-show="step === 2" x-transition.opacity style="display: none;">
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4 text-center">Bagaimana
                            kejelasan INFORMASI pelayanan?</h3>
                        <div class="flex justify-center space-x-4">
                            <template x-for="i in 4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="nilai_informasi" :value="i"
                                        class="hidden peer">
                                    <div
                                        class="w-16 h-16 flex items-center justify-center rounded-full border-2 border-gray-300 peer-checked:border-blue-500 peer-checked:bg-blue-100 dark:peer-checked:bg-blue-900 text-2xl font-bold hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <span x-text="i"></span>
                                    </div>
                                    <div class="text-center text-xs mt-1"
                                        x-text="['Buruk', 'Cukup', 'Baik', 'Sangat Baik'][i-1]"></div>
                                </label>
                            </template>
                        </div>
                    </div>

                    <!-- Step 3: Kecepatan -->
                    <div x-show="step === 3" x-transition.opacity style="display: none;">
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4 text-center">Bagaimana
                            KECEPATAN pelayanan?</h3>
                        <div class="flex justify-center space-x-4">
                            <template x-for="i in 4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="nilai_kecepatan" :value="i"
                                        class="hidden peer">
                                    <div
                                        class="w-16 h-16 flex items-center justify-center rounded-full border-2 border-gray-300 peer-checked:border-blue-500 peer-checked:bg-blue-100 dark:peer-checked:bg-blue-900 text-2xl font-bold hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <span x-text="i"></span>
                                    </div>
                                </label>
                            </template>
                        </div>
                    </div>

                    <!-- Step 4: Sikap -->
                    <div x-show="step === 4" x-transition.opacity style="display: none;">
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4 text-center">Bagaimana SIKAP
                            petugas?</h3>
                        <div class="flex justify-center space-x-4">
                            <template x-for="i in 4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="nilai_sikap" :value="i" class="hidden peer">
                                    <div
                                        class="w-16 h-16 flex items-center justify-center rounded-full border-2 border-gray-300 peer-checked:border-blue-500 peer-checked:bg-blue-100 dark:peer-checked:bg-blue-900 text-2xl font-bold hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <span x-text="i"></span>
                                    </div>
                                </label>
                            </template>
                        </div>
                    </div>

                    <!-- Step 5: Prosedur -->
                    <div x-show="step === 5" x-transition.opacity style="display: none;">
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4 text-center">Bagaimana
                            kemudahan PROSEDUR pelayanan?</h3>
                        <div class="flex justify-center space-x-4">
                            <template x-for="i in 4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="nilai_prosedur" :value="i"
                                        class="hidden peer">
                                    <div
                                        class="w-16 h-16 flex items-center justify-center rounded-full border-2 border-gray-300 peer-checked:border-blue-500 peer-checked:bg-blue-100 dark:peer-checked:bg-blue-900 text-2xl font-bold hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <span x-text="i"></span>
                                    </div>
                                </label>
                            </template>
                        </div>
                    </div>

                    <!-- Step 6: Komentar & Selesai -->
                    <div x-show="step === 6" x-transition.opacity style="display: none;">
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4 text-center">Kritik dan
                            Saran (Opsional)</h3>
                        <div class="mb-4">
                            <textarea name="komentar" rows="4"
                                class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                        </div>
                        <div class="text-center">
                            <x-primary-button>
                                {{ __('Kirim Survei') }}
                            </x-primary-button>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="mt-8 flex justify-between absolute bottom-6 left-6 right-6">
                        <button type="button" @click="step--" x-show="step > 1"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Kembali
                        </button>
                        <div class="flex-1"></div> <!-- Spacer -->
                        <button type="button" @click="step++" x-show="step < maxStep"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Lanjut
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
