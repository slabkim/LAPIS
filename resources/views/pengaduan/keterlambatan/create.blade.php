<x-user-layout>
    <x-slot name="title">Pengaduan Keterlambatan Berkas - LAPIS</x-slot>

    <main class="relative z-10 flex flex-1 flex-col items-center justify-center p-4 sm:p-6 lg:p-10 min-h-screen">
        <!-- Page Header Section -->
        <div class="w-full max-w-4xl mb-8 text-center md:text-left">
            <h2 class="text-gray-900 text-3xl md:text-4xl font-black leading-tight tracking-tight">
                Formulir Pengaduan <br />
                <span class="text-blue-600">Keterlambatan Berkas</span>
            </h2>
            <p class="text-gray-600 text-base md:text-lg mt-2 font-normal leading-relaxed max-w-2xl">
                Sampaikan kendala keterlambatan dokumen kependudukan Anda untuk segera kami tindak lanjuti.
            </p>
        </div>

        <!-- Form Card -->
        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            <!-- Form Progress Bar -->
            <div class="h-2 bg-gray-100 w-full flex">
                <div class="h-full bg-blue-600 w-1/3"></div>
                <div class="h-full bg-red-600 w-1/3 opacity-80"></div>
                <div class="h-full bg-gray-300 w-1/3"></div>
            </div>

            <!-- Status Message -->
            @if (session('status'))
                <div class="mx-6 mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-green-600">check_circle</span>
                        <p class="text-sm text-green-800 font-medium">
                            {{ session('status') }}
                        </p>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('pengaduan.keterlambatan') }}" enctype="multipart/form-data"
                class="p-6 md:p-10">
                @csrf

                <!-- Section: Detail Dokumen -->
                <div class="mb-8">
                    <h3
                        class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2 border-b border-gray-100 pb-2">
                        <span
                            class="bg-blue-100 text-blue-600 w-8 h-8 rounded-full flex items-center justify-center text-sm">1</span>
                        Detail Dokumen
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Jenis Layanan -->
                        <label class="flex flex-col flex-1">
                            <span class="text-gray-900 text-sm font-semibold mb-2">
                                Jenis Layanan <span class="text-red-600">*</span>
                            </span>
                            <div class="relative">
                                <select id="id_layanan" name="id_layanan" required
                                    class="form-select w-full rounded-lg border border-gray-300 bg-gray-50 focus:bg-white text-gray-900 h-12 px-4 pr-10 focus:ring-2 focus:ring-blue-500 focus:border-blue-600 transition-all appearance-none cursor-pointer">
                                    <option value="" disabled selected>Pilih jenis dokumen</option>
                                    @foreach ($layanan as $l)
                                        <option value="{{ $l->id_layanan }}">{{ $l->nama_layanan }}</option>
                                    @endforeach
                                </select>
                                <span
                                    class="absolute right-3 top-3 text-gray-500 pointer-events-none material-symbols-outlined">expand_more</span>
                            </div>
                            <x-input-error :messages="$errors->get('id_layanan')" class="mt-1" />
                        </label>

                        <!-- Tenggat Waktu Berkas -->
                        <label class="flex flex-col flex-1">
                            <span class="text-gray-900 text-sm font-semibold mb-2">
                                Tenggat Waktu Berkas <span class="text-red-600">*</span>
                            </span>
                            <div class="relative">
                                <input type="date" id="tenggat_berkas" name="tenggat_berkas"
                                    value="{{ old('tenggat_berkas') }}" required
                                    class="form-input w-full rounded-lg border border-gray-300 bg-gray-50 focus:bg-white text-gray-900 h-12 px-4 placeholder:text-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-600 transition-all" />
                                <span
                                    class="absolute right-3 top-3 text-gray-400 pointer-events-none material-symbols-outlined">calendar_today</span>
                            </div>
                            <x-input-error :messages="$errors->get('tenggat_berkas')" class="mt-1" />
                        </label>
                    </div>

                    <!-- File Upload -->
                    <label class="flex flex-col w-full">
                        <span class="text-gray-900 text-sm font-semibold mb-2">
                            Lampiran Bukti (Foto Resi/Dokumen) <span class="text-red-600">*</span>
                        </span>
                        <div
                            class="w-full border-2 border-dashed border-gray-300 hover:border-blue-600 rounded-xl bg-gray-50 hover:bg-blue-50 transition-all cursor-pointer group p-8 flex flex-col items-center justify-center text-center relative">
                            <input type="file" id="bukti" name="bukti[]" multiple accept=".pdf,image/*" required
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" />
                            <div
                                class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-blue-600 text-2xl">cloud_upload</span>
                            </div>
                            <p class="text-sm font-medium text-gray-900">Klik untuk unggah atau seret berkas</p>
                            <p class="text-xs text-gray-500 mt-1">Format JPG, PNG, atau PDF (Maks. 20MB)</p>
                        </div>
                        <x-input-error :messages="$errors->get('bukti')" class="mt-1" />
                    </label>
                </div>

                <!-- Action Buttons -->
                <div
                    class="flex flex-col-reverse sm:flex-row items-center justify-end gap-4 pt-6 border-t border-gray-100">
                    <a href="{{ route('dashboard') }}"
                        class="w-full sm:w-auto px-6 h-12 rounded-lg border border-gray-300 text-gray-700 font-bold hover:bg-gray-50 hover:text-red-600 transition-colors flex items-center justify-center gap-2">
                        Batal
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-8 h-12 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold shadow-lg shadow-blue-200 transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-xl">send</span>
                        Kirim Pengaduan
                    </button>
                </div>

                <!-- Privacy Notice -->
                <div class="flex items-start gap-2 bg-blue-50 p-3 rounded-lg mt-6">
                    <span class="material-symbols-outlined text-blue-600 text-sm mt-0.5">lock</span>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Data pengaduan Anda dienkripsi dan hanya dapat diakses oleh tim yang berwenang. Kami berkomitmen
                        melindungi privasi pelapor sesuai dengan Undang-Undang Perlindungan Data Pribadi.
                    </p>
                </div>
            </form>
        </div>
    </main>
</x-user-layout>
