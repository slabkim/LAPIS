<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pengaduan Keterlambatan Berkas') }}
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

                <form method="POST" action="{{ route('pengaduan.keterlambatan') }}" enctype="multipart/form-data">
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

                    <!-- Tenggat Berkas -->
                    <div class="mb-4">
                        <x-input-label for="tenggat_berkas" :value="__('Tenggat Berkas')" />
                        <x-text-input id="tenggat_berkas" class="block mt-1 w-full" type="date" name="tenggat_berkas"
                            :value="old('tenggat_berkas')" required />
                        <x-input-error :messages="$errors->get('tenggat_berkas')" class="mt-2" />
                    </div>

                    <!-- Lampiran -->
                    <div class="mb-4">
                        <x-input-label for="bukti" :value="__('Lampiran Dokumen (Foto atau PDF)')" />
                        <input id="bukti" type="file" name="bukti[]" multiple accept=".pdf,image/*"
                            class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            required />
                        <x-input-error :messages="$errors->get('bukti')" class="mt-2" />
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
