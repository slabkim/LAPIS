<x-user-layout>
    <x-slot name="title">Survei Kepuasan Masyarakat - LAPIS</x-slot>

    <main class="relative z-10 flex flex-1 flex-col items-center justify-center p-4 sm:p-6 lg:p-10 min-h-screen">
        <!-- Page Header -->
        <div class="w-full max-w-4xl mb-8 text-center">
            <h2 class="text-gray-900 text-3xl md:text-4xl font-black leading-tight tracking-tight">
                Survei Kepuasan <span class="text-blue-600">Masyarakat</span>
            </h2>
            <p class="text-gray-600 text-base md:text-lg mt-2 font-normal leading-relaxed max-w-2xl mx-auto">
                Bantu kami meningkatkan kualitas pelayanan dengan memberikan penilaian Anda.
            </p>
        </div>

        <!-- Survey Card -->
        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden"
            x-data="surveyForm()">

            <!-- Progress Bar -->
            <div class="h-2 bg-gray-100 w-full flex">
                <div class="h-full bg-blue-600 transition-all duration-300"
                    :style="'width: ' + ((step / totalSteps) * 100) + '%'"></div>
            </div>

            <form method="POST" action="{{ route('survei.store') }}" class="p-6 md:p-10">
                @csrf

                <!-- Step 1: Jenis Layanan -->
                <div x-show="step === 1" x-transition.opacity>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                        Layanan apa yang Anda terima?
                    </h3>
                    <div class="mb-6">
                        <select id="id_layanan" name="id_layanan" required
                            class="w-full text-lg border-gray-300 bg-gray-50 focus:bg-white text-gray-900 rounded-lg p-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-600 transition-all">
                            <option value="">Pilih Layanan</option>
                            @foreach ($layanan as $l)
                                <option value="{{ $l->id_layanan }}">{{ $l->nama_layanan }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('id_layanan')" class="mt-2" />
                    </div>
                </div>

                <!-- Step 2-5: Rating Questions with Emojis -->
                <template x-for="(question, index) in questions" :key="index">
                    <div x-show="step === index + 2" x-transition.opacity style="display: none;">
                        <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center" x-text="question.title"></h3>

                        <div class="flex justify-center gap-4 flex-wrap">
                            <template x-for="rating in ratings" :key="rating.value">
                                <label class="cursor-pointer group">
                                    <input type="radio" :name="question.field" :value="rating.value"
                                        x-model="answers[question.field]" @change="calculateAverage()"
                                        class="hidden peer" required>
                                    <div
                                        class="flex flex-col items-center gap-2 p-4 rounded-xl border-2 border-gray-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-gray-50 transition-all transform peer-checked:scale-105">
                                        <div class="text-5xl" x-text="rating.emoji"></div>
                                        <div class="text-xs font-medium text-gray-600 peer-checked:text-blue-700"
                                            x-text="rating.label"></div>
                                    </div>
                                </label>
                            </template>
                        </div>
                    </div>
                </template>

                <!-- Step 6: Komentar & Average Score -->
                <div x-show="step === 6" x-transition.opacity style="display: none;">
                    <!-- Average Score Display -->
                    <div x-show="average > 0"
                        class="mb-8 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200">
                        <div class="text-center">
                            <p class="text-sm font-semibold text-gray-600 mb-2">Rata-rata Kepuasan Anda</p>
                            <div class="flex items-center justify-center gap-3 mb-3">
                                <div class="text-5xl" x-text="getAverageEmoji()"></div>
                                <div class="text-4xl font-black text-gray-900">
                                    <span x-text="average.toFixed(1)"></span>
                                    <span class="text-2xl text-gray-400">/ 5.0</span>
                                </div>
                            </div>
                            <p class="text-sm font-medium" :class="getAverageColorClass()" x-text="getAverageText()">
                            </p>
                        </div>
                    </div>

                    <!-- Komentar -->
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">
                        Kritik dan Saran (Opsional)
                    </h3>
                    <p class="text-gray-600 text-sm text-center mb-6">
                        Silakan berikan masukan untuk membantu kami meningkatkan pelayanan
                    </p>
                    <div class="mb-6">
                        <textarea name="komentar" rows="5"
                            class="w-full border-gray-300 bg-gray-50 focus:bg-white text-gray-900 rounded-lg p-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-600 transition-all resize-y"
                            placeholder="Tuliskan pengalaman Anda atau saran perbaikan..."></textarea>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-200">
                    <button type="button" @click="prevStep()" x-show="step > 1"
                        class="px-6 h-12 rounded-lg border border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">arrow_back</span>
                        Kembali
                    </button>

                    <div class="flex-1"></div>

                    <button type="button" @click="nextStep()" x-show="step < totalSteps"
                        class="px-8 h-12 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                        Lanjut
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </button>

                    <button type="submit" x-show="step === totalSteps"
                        class="px-8 h-12 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold shadow-lg shadow-blue-200 transition-all transform hover:-translate-y-0.5 flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">send</span>
                        Kirim Survei
                    </button>
                </div>

                <!-- Step Counter -->
                <div class="text-center mt-6">
                    <p class="text-sm text-gray-500">
                        Langkah <span x-text="step"></span> dari <span x-text="totalSteps"></span>
                    </p>
                </div>
            </form>
        </div>
    </main>

    <script>
        function surveyForm() {
            return {
                step: 1,
                totalSteps: 6,
                answers: {
                    nilai_informasi: null,
                    nilai_kecepatan: null,
                    nilai_sikap: null,
                    nilai_prosedur: null
                },
                average: 0,
                questions: [{
                        field: 'nilai_informasi',
                        title: 'Bagaimana kejelasan INFORMASI pelayanan?'
                    },
                    {
                        field: 'nilai_kecepatan',
                        title: 'Bagaimana KECEPATAN pelayanan?'
                    },
                    {
                        field: 'nilai_sikap',
                        title: 'Bagaimana SIKAP petugas?'
                    },
                    {
                        field: 'nilai_prosedur',
                        title: 'Bagaimana kemudahan PROSEDUR pelayanan?'
                    }
                ],
                ratings: [{
                        value: 1,
                        emoji: '😠',
                        label: 'Sangat Tidak Puas'
                    },
                    {
                        value: 2,
                        emoji: '😟',
                        label: 'Tidak Puas'
                    },
                    {
                        value: 3,
                        emoji: '😐',
                        label: 'Cukup'
                    },
                    {
                        value: 4,
                        emoji: '🙂',
                        label: 'Puas'
                    },
                    {
                        value: 5,
                        emoji: '😊',
                        label: 'Sangat Puas'
                    }
                ],

                calculateAverage() {
                    const values = Object.values(this.answers).filter(v => v !== null);
                    if (values.length > 0) {
                        this.average = values.reduce((sum, val) => sum + parseInt(val), 0) / values.length;
                    }
                },

                getAverageEmoji() {
                    if (this.average >= 4.5) return '😊';
                    if (this.average >= 3.5) return '🙂';
                    if (this.average >= 2.5) return '😐';
                    if (this.average >= 1.5) return '😟';
                    return '😠';
                },

                getAverageText() {
                    if (this.average >= 4.5) return 'Sangat Bagus! Anda puas dengan layanan kami.';
                    if (this.average >= 3.5) return 'Bagus! Anda cukup puas dengan layanan kami.';
                    if (this.average >= 2.5) return 'Cukup. Masih ada ruang untuk perbaikan.';
                    if (this.average >= 1.5) return 'Kurang Memuaskan. Kami akan berusaha lebih baik.';
                    return 'Perlu Perbaikan Serius. Mohon maaf atas ketidaknyamanan Anda.';
                },

                getAverageColorClass() {
                    if (this.average >= 4.5) return 'text-green-700';
                    if (this.average >= 3.5) return 'text-blue-700';
                    if (this.average >= 2.5) return 'text-yellow-700';
                    if (this.average >= 1.5) return 'text-orange-700';
                    return 'text-red-700';
                },

                nextStep() {
                    if (this.step < this.totalSteps) {
                        this.step++;
                    }
                },

                prevStep() {
                    if (this.step > 1) {
                        this.step--;
                    }
                }
            }
        }
    </script>
</x-user-layout>
