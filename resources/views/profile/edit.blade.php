<x-user-layout>
    <x-slot name="title">Profil Pengguna - LAPIS</x-slot>

    <main class="flex-1 w-full flex flex-col">
        <!-- Hero Banner -->
        <div class="relative w-full h-48 md:h-64 bg-gradient-to-r from-blue-900 to-blue-700">
            <div class="absolute inset-0 opacity-20"
                style="background-image: url('{{ asset('assets/images/Background_LAPIS.png') }}'); background-size: cover; background-position: center;">
            </div>
        </div>

        <div class="px-4 md:px-10 lg:px-40 flex flex-1 justify-center -mt-20 md:-mt-24 pb-12 z-10">
            <div class="layout-content-container flex flex-col max-w-[1024px] flex-1 w-full gap-6">

                <!-- Profile Card -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6 md:p-8">
                    <div class="flex flex-col md:flex-row gap-6 items-start md:items-center justify-between">
                        <div
                            class="flex flex-col md:flex-row gap-6 items-center md:items-start text-center md:text-left w-full">
                            <!-- Profile Photo -->
                            <div class="relative group">
                                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-24 md:size-32 border-4 border-white shadow-md"
                                    style="background-image: url('{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}');">
                                </div>
                            </div>

                            <!-- User Info -->
                            <div class="flex flex-col justify-center flex-1">
                                <h1 class="text-gray-900 text-2xl md:text-3xl font-bold leading-tight mb-1">
                                    {{ Auth::user()->name }}
                                </h1>
                                <p
                                    class="text-gray-600 text-base font-normal flex items-center gap-2 justify-center md:justify-start">
                                    <span class="material-symbols-outlined text-[18px]">mail</span>
                                    {{ Auth::user()->email }}
                                </p>
                                <div class="mt-3 flex flex-wrap gap-2 justify-center md:justify-start">
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Warga Kota Bandar Lampung
                                    </span>
                                    @if (Auth::user()->email_verified_at)
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <span class="material-symbols-outlined text-xs">verified</span>
                                            Akun Terverifikasi
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Edit Profile Button (Opens Modal) -->
                        <div class="w-full md:w-auto flex justify-center">
                            <button onclick="document.getElementById('editProfileModal').classList.remove('hidden')"
                                class="flex min-w-[140px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-blue-600 text-white hover:bg-blue-700 text-sm font-bold shadow-md transition-all gap-2 w-full md:w-auto">
                                <span class="material-symbols-outlined text-[20px]">edit</span>
                                <span>Ubah Profil</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Stats / Sidebar Info -->
                    <div class="lg:col-span-1 flex flex-col gap-6">
                        <!-- Stats Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Statistik Pengaduan</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-blue-50 p-4 rounded-lg text-center">
                                    <span
                                        class="block text-2xl font-black text-blue-600 mb-1">{{ $stats['total'] }}</span>
                                    <span class="text-xs text-gray-600 font-medium uppercase tracking-wide">Total</span>
                                </div>
                                <div class="bg-green-50 p-4 rounded-lg text-center">
                                    <span
                                        class="block text-2xl font-black text-green-600 mb-1">{{ $stats['selesai'] }}</span>
                                    <span
                                        class="text-xs text-gray-600 font-medium uppercase tracking-wide">Selesai</span>
                                </div>
                                <div class="bg-yellow-50 p-4 rounded-lg text-center">
                                    <span
                                        class="block text-2xl font-black text-yellow-600 mb-1">{{ $stats['proses'] }}</span>
                                    <span
                                        class="text-xs text-gray-600 font-medium uppercase tracking-wide">Proses</span>
                                </div>
                                <div class="bg-red-50 p-4 rounded-lg text-center">
                                    <span
                                        class="block text-2xl font-black text-red-600 mb-1">{{ $stats['ditolak'] }}</span>
                                    <span
                                        class="text-xs text-gray-600 font-medium uppercase tracking-wide">Ditolak</span>
                                </div>
                            </div>
                        </div>

                        <!-- Info Card -->
                        <div
                            class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl shadow-sm p-6 text-white relative overflow-hidden">
                            <div class="relative z-10">
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="material-symbols-outlined text-yellow-300 text-3xl">lightbulb</span>
                                    <h3 class="text-lg font-bold">Tahukah Anda?</h3>
                                </div>
                                <p class="text-blue-50 text-sm leading-relaxed mb-4">
                                    Anda dapat memantau progres pengaduan Anda melalui halaman dashboard atau menerima
                                    notifikasi email.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- History Table -->
                    <div class="lg:col-span-2 flex flex-col gap-6">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 flex flex-col h-full">
                            <div
                                class="p-6 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                <div>
                                    <h2 class="text-gray-900 text-xl font-bold leading-tight">Riwayat Pengaduan</h2>
                                    <p class="text-sm text-gray-500 mt-1">Daftar laporan yang pernah Anda ajukan</p>
                                </div>
                            </div>

                            <div class="overflow-x-auto flex-1 p-2">
                                @if ($history->isEmpty())
                                    <div class="flex flex-col items-center justify-center py-12 text-center">
                                        <span class="material-symbols-outlined text-gray-300 text-6xl mb-4">inbox</span>
                                        <p class="text-gray-500 font-medium">Belum ada riwayat pengaduan</p>
                                        <p class="text-gray-400 text-sm mt-1">Pengaduan Anda akan muncul di sini</p>
                                    </div>
                                @else
                                    <table class="w-full text-left border-collapse">
                                        <thead>
                                            <tr class="border-b border-gray-100">
                                                <th class="p-4 text-xs font-bold tracking-wide text-gray-500 uppercase">
                                                    Jenis Pengaduan</th>
                                                <th class="p-4 text-xs font-bold tracking-wide text-gray-500 uppercase">
                                                    Tanggal</th>
                                                <th class="p-4 text-xs font-bold tracking-wide text-gray-500 uppercase">
                                                    Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-50">
                                            @foreach ($history as $item)
                                                <tr class="hover:bg-gray-50 transition-colors group">
                                                    <td class="p-4">
                                                        <div class="flex items-center gap-3">
                                                            <div
                                                                class="size-8 rounded bg-blue-50 flex items-center justify-center text-blue-600">
                                                                <span
                                                                    class="material-symbols-outlined text-[18px]">{{ $item['icon'] }}</span>
                                                            </div>
                                                            <div>
                                                                <p class="font-semibold text-gray-900 text-sm">
                                                                    {{ $item['title'] }}</p>
                                                                <p class="text-xs text-gray-500">
                                                                    #{{ str_pad($item['id'], 3, '0', STR_PAD_LEFT) }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="p-4 text-sm text-gray-600 whitespace-nowrap">
                                                        {{ $item['date']->format('d M Y') }}
                                                    </td>
                                                    <td class="p-4">
                                                        @php
                                                            $statusColors = [
                                                                'Selesai' =>
                                                                    'bg-green-100 text-green-700 border-green-200',
                                                                'Diproses' =>
                                                                    'bg-yellow-100 text-yellow-700 border-yellow-200',
                                                                'Ditolak' => 'bg-red-100 text-red-700 border-red-200',
                                                                'default' =>
                                                                    'bg-gray-100 text-gray-700 border-gray-200',
                                                            ];
                                                            $color =
                                                                $statusColors[$item['status']] ??
                                                                $statusColors['default'];
                                                        @endphp
                                                        <span
                                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium border {{ $color }}">
                                                            <span class="size-1.5 rounded-full bg-current"></span>
                                                            {{ $item['status'] }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Modal -->
        <div id="editProfileModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4"
            onclick="if(event.target === this) this.classList.add('hidden')">
            <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white">
                    <h2 class="text-2xl font-bold text-gray-900">Edit Profil</h2>
                    <button onclick="document.getElementById('editProfileModal').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600 transition-colors">
                        <span class="material-symbols-outlined text-3xl">close</span>
                    </button>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Profile Information Form -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Profil</h3>
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <hr class="border-gray-200">

                    <!-- Update Password Form -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ubah Password</h3>
                        @include('profile.partials.update-password-form')
                    </div>

                    <hr class="border-gray-200">

                    <!-- Delete Account Form -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Hapus Akun</h3>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-user-layout>
