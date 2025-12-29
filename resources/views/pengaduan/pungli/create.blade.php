<x-user-layout>
    <x-slot name="title">Pengaduan Pungli & Calo - LAPIS</x-slot>

    <main class="relative z-10 flex flex-1 flex-col items-center justify-center p-4 sm:p-6 lg:p-10 min-h-screen">
        <div class="w-full max-w-3xl bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-6 sm:p-8 text-white relative overflow-hidden">
                <div class="absolute right-0 top-0 h-full w-1/3 opacity-10"></div>
                <h1 class="text-2xl sm:text-3xl font-black leading-tight tracking-tight relative z-10">Layanan Pengaduan
                    Pungli & Calo</h1>
                <p class="mt-2 text-blue-100 text-sm sm:text-base font-normal max-w-xl relative z-10">
                    Bantu kami memberantas pungli di lingkungan Disdukcapil Kota Bandar Lampung. Identitas pelapor
                    dijamin kerahasiaannya.
                </p>
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

            <form method="POST" action="{{ route('pengaduan.pungli') }}" enctype="multipart/form-data"
                class="p-6 sm:p-8 flex flex-col gap-6">
                @csrf

                <!-- Section 1: Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Jenis Layanan -->
                    <div class="flex flex-col gap-2">
                        <label class="text-gray-900 text-sm font-bold leading-normal">
                            Jenis Layanan <span class="text-red-600">*</span>
                        </label>
                        <div class="relative">
                            <select id="id_layanan" name="id_layanan" required
                                class="w-full appearance-none rounded-lg border border-gray-300 bg-gray-50 text-gray-900 h-12 px-4 pr-10 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all">
                                <option value="" disabled selected>Pilih layanan yang diadukan</option>
                                @foreach ($layanan as $l)
                                    <option value="{{ $l->id_layanan }}">{{ $l->nama_layanan }}</option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-600">
                                <span class="material-symbols-outlined text-xl">expand_more</span>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('id_layanan')" class="mt-1" />
                    </div>

                    <!-- Tanggal Kejadian -->
                    <div class="flex flex-col gap-2">
                        <label class="text-gray-900 text-sm font-bold leading-normal">
                            Tanggal Kejadian <span class="text-red-600">*</span>
                        </label>
                        <div class="relative">
                            <input type="date" id="tanggal_kejadian" name="tanggal_kejadian"
                                value="{{ old('tanggal_kejadian') }}" required
                                class="w-full rounded-lg border border-gray-300 bg-gray-50 text-gray-900 h-12 px-4 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all" />
                        </div>
                        <x-input-error :messages="$errors->get('tanggal_kejadian')" class="mt-1" />
                    </div>
                </div>

                <!-- Nominal -->
                <div class="flex flex-col gap-2">
                    <label class="text-gray-900 text-sm font-bold leading-normal flex justify-between">
                        <span>Estimasi Nominal Pungli</span>
                        <span class="text-gray-500 text-xs font-normal">(Opsional)</span>
                    </label>
                    <div class="relative flex items-center">
                        <span class="absolute left-4 text-gray-600 font-medium">Rp</span>
                        <input type="number" id="nominal" name="nominal" value="{{ old('nominal') }}" placeholder="0"
                            class="w-full rounded-lg border border-gray-300 bg-gray-50 text-gray-900 h-12 pl-10 pr-4 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all placeholder:text-gray-500" />
                    </div>
                    <x-input-error :messages="$errors->get('nominal')" class="mt-1" />
                </div>

                <!-- Kronologi -->
                <div class="flex flex-col gap-2">
                    <label class="text-gray-900 text-sm font-bold leading-normal">
                        Kronologi Kejadian <span class="text-red-600">*</span>
                    </label>
                    <textarea id="kronologi" name="kronologi" rows="5" required
                        class="w-full rounded-lg border border-gray-300 bg-gray-50 text-gray-900 p-4 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all resize-y placeholder:text-gray-500"
                        placeholder="Ceritakan detail kejadian secara lengkap (lokasi, oknum, modus, dll)...">{{ old('kronologi') }}</textarea>
                    <p class="text-xs text-gray-500">Minimal 20 karakter.</p>
                    <x-input-error :messages="$errors->get('kronologi')" class="mt-1" />
                </div>

                <!-- Lampiran Bukti -->
                <div class="flex flex-col gap-2">
                    <label class="text-gray-900 text-sm font-bold leading-normal">
                        Lampiran Bukti (Foto/Video) <span class="text-red-600">*</span>
                    </label>
                    <div class="w-full border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 hover:border-blue-500 transition-all cursor-pointer p-6 relative"
                        id="uploadArea">
                        <input type="file" id="bukti" name="bukti[]" multiple accept="image/*,video/*" required
                            onchange="handleFileSelect(event)"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" />

                        <!-- Upload Placeholder -->
                        <div id="uploadPlaceholder"
                            class="flex flex-col items-center justify-center text-center pointer-events-none">
                            <div class="size-12 rounded-full bg-blue-50 flex items-center justify-center mb-3">
                                <span class="material-symbols-outlined text-blue-600 text-2xl">cloud_upload</span>
                            </div>
                            <p class="text-sm font-medium text-gray-900">Klik untuk upload atau drag & drop</p>
                            <p class="text-xs text-gray-500 mt-1">PNG, JPG, atau MP4 (Maks. 20MB)</p>
                        </div>

                        <!-- File Preview (Hidden by default) -->
                        <div id="filePreview" class="hidden w-full pointer-events-none">
                            <div class="flex items-center gap-3 mb-3 text-green-700 bg-green-50 p-3 rounded-lg">
                                <span class="material-symbols-outlined">check_circle</span>
                                <span class="font-semibold text-sm" id="fileCount"></span>
                            </div>
                            <div id="fileList" class="space-y-2 max-h-40 overflow-y-auto"></div>
                            <button type="button" onclick="clearFiles()"
                                class="mt-3 text-sm text-blue-600 hover:text-blue-700 font-medium pointer-events-auto">
                                Hapus Semua File
                            </button>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('bukti')" class="mt-1" />
                </div>

                <hr class="border-gray-200 my-2" />

                <!-- Footer Actions -->
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <!-- Anonymous Toggle -->
                    <label class="inline-flex items-center cursor-pointer group/toggle">
                        <input type="checkbox" id="is_anonim" name="is_anonim" value="1" class="sr-only peer" />
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 flex items-center gap-2">
                            Lapor sebagai Anonim
                            <span class="material-symbols-outlined text-gray-400 text-sm"
                                title="Identitas Anda tidak akan disimpan">help</span>
                        </span>
                    </label>

                    <!-- Submit Button -->
                    <div class="flex w-full md:w-auto gap-3">
                        <a href="{{ route('dashboard') }}"
                            class="flex-1 md:flex-none h-12 px-6 rounded-lg border border-gray-300 text-gray-600 font-bold hover:bg-gray-50 transition-colors flex items-center justify-center">
                            Batal
                        </a>
                        <button type="submit"
                            class="flex-1 md:flex-none h-12 px-8 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-lg">send</span>
                            Kirim Laporan
                        </button>
                    </div>
                </div>

                <!-- Disclaimer -->
                <div class="flex items-start gap-2 bg-blue-50 p-3 rounded-lg mt-2">
                    <span class="material-symbols-outlined text-blue-600 text-sm mt-0.5">lock</span>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Data laporan Anda dienkripsi dan hanya dapat diakses oleh tim investigasi internal. Kami
                        berkomitmen melindungi pelapor sesuai dengan Undang-Undang Perlindungan Saksi dan Korban.
                    </p>
                </div>
            </form>
        </div>
    </main>

    <script>
        function handleFileSelect(event) {
            const files = event.target.files;
            const fileCount = document.getElementById('fileCount');
            const fileList = document.getElementById('fileList');
            const uploadPlaceholder = document.getElementById('uploadPlaceholder');
            const filePreview = document.getElementById('filePreview');

            if (files.length > 0) {
                uploadPlaceholder.classList.add('hidden');
                filePreview.classList.remove('hidden');

                fileCount.textContent = `${files.length} file terpilih`;
                fileList.innerHTML = '';

                Array.from(files).forEach((file, index) => {
                    const fileItem = document.createElement('div');
                    fileItem.className =
                        'flex items-center gap-3 p-2 bg-white rounded border border-gray-200 text-left';

                    const icon = file.type.startsWith('image/') ? 'image' : 'videocam';
                    const size = (file.size / 1024 / 1024).toFixed(2);

                    fileItem.innerHTML = `
                        <span class="material-symbols-outlined text-blue-600">${icon}</span>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">${file.name}</p>
                            <p class="text-xs text-gray-500">${size} MB</p>
                        </div>
                    `;

                    fileList.appendChild(fileItem);
                });
            }
        }

        function clearFiles() {
            const fileInput = document.getElementById('bukti');
            fileInput.value = '';

            document.getElementById('uploadPlaceholder').classList.remove('hidden');
            document.getElementById('filePreview').classList.add('hidden');
        }
    </script>
</x-user-layout>
