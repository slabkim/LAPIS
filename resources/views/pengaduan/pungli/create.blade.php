<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pengaduan Pungli & Calo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Status Message -->
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('pengaduan.pungli') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Jenis Layanan -->
                    <div class="mb-4">
                        <x-input-label for="id_layanan" :value="__('Jenis Layanan')" />
                        <select id="id_layanan" name="id_layanan"
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            required>
                            <option value="">Pilih Layanan</option>
                            @foreach ($layanan as $l)
                                <option value="{{ $l->id_layanan }}">{{ $l->nama_layanan }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('id_layanan')" class="mt-2" />
                    </div>

                    <!-- Kategori (Pungli/Calo) -->
                    <div class="mb-4">
                        <x-input-label for="id_kategori" :value="__('Kategori')" />
                        <select id="id_kategori" name="id_kategori"
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="1">Pungutan Liar (Pungli)</option>
                            <option value="2">Percaloan</option>
                        </select>
                    </div>

                    <!-- Tanggal Kejadian -->
                    <div class="mb-4">
                        <x-input-label for="tanggal_kejadian" :value="__('Tanggal Kejadian')" />
                        <x-text-input id="tanggal_kejadian" class="block mt-1 w-full" type="date"
                            name="tanggal_kejadian" :value="old('tanggal_kejadian')" required />
                        <x-input-error :messages="$errors->get('tanggal_kejadian')" class="mt-2" />
                    </div>

                    <!-- Nominal -->
                    <div class="mb-4">
                        <x-input-label for="nominal" :value="__('Nominal (Opsional)')" />
                        <x-text-input id="nominal" class="block mt-1 w-full" type="number" name="nominal"
                            :value="old('nominal')" placeholder="Rp" />
                        <x-input-error :messages="$errors->get('nominal')" class="mt-2" />
                    </div>

                    <!-- Kronologi -->
                    <div class="mb-4">
                        <x-input-label for="kronologi" :value="__('Kronologi Kejadian')" />
                        <textarea id="kronologi" name="kronologi" rows="4"
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            required>{{ old('kronologi') }}</textarea>
                        <x-input-error :messages="$errors->get('kronologi')" class="mt-2" />
                    </div>

                    <!-- Lampiran -->
                    <div class="mb-4">
                        <x-input-label for="bukti" :value="__('Lampiran Bukti (Foto & Video)')" />
                        <input id="bukti" type="file" name="bukti[]" multiple accept="image/*,video/*"
                            class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            required />
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Upload minimal 1
                            Foto dan 1 Video.</p>
                        <x-input-error :messages="$errors->get('bukti')" class="mt-2" />
                    </div>

                    <!-- Anonim -->
                    <div class="block mt-4 mb-4">
                        <label for="is_anonim" class="inline-flex items-center">
                            <input id="is_anonim" type="checkbox"
                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                name="is_anonim" value="1">
                            <span
                                class="ms-2 text-sm text-gray-600 dark:text-gray-400 font-semibold">{{ __('Kirim sebagai Anonim (Identitas disembunyikan)') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-3">
                            {{ __('Kirim Pengaduan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
