<x-admin-layout>
    <x-slot name="header">
        {{ __('Manajemen Jenis Layanan') }}
    </x-slot>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">

            <!-- Tambah Layanan Button & Modal Trigger -->
            <div class="mb-4 flex justify-between items-center">
                <h3 class="text-lg font-semibold">Daftar Layanan</h3>
                <button type="button" onclick="document.getElementById('addModal').showModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Tambah Layanan
                </button>
            </div>

            <!-- Status Message -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ session('status') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Nama Layanan
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($layanan as $l)
                            <tr>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                    <p class="text-gray-900 dark:text-gray-300 whitespace-no-wrap">
                                        {{ $l->nama_layanan }}
                                    </p>
                                </td>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold leading-tight {{ $l->status_aktif ? 'text-green-900' : 'text-red-900' }}">
                                        <span aria-hidden
                                            class="absolute inset-0 {{ $l->status_aktif ? 'bg-green-200' : 'bg-red-200' }} opacity-50 rounded-full"></span>
                                        <span class="relative">{{ $l->status_aktif ? 'Aktif' : 'Non-Aktif' }}</span>
                                    </span>
                                </td>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                    <button
                                        onclick="openEditModal({{ $l->id_layanan }}, '{{ $l->nama_layanan }}', {{ $l->status_aktif }})"
                                        class="text-blue-600 hover:text-blue-900 mr-2">Edit</button>

                                    <form action="{{ route('admin.master.jenis_layanan.destroy', $l->id_layanan) }}"
                                        method="POST" class="inline-block"
                                        onsubmit="return confirm('Yakin ingin menghapus layanan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"
                                    class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-center">
                                    Tidak ada data layanan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div
                    class="px-5 py-5 bg-white dark:bg-gray-800 border-t flex flex-col xs:flex-row items-center xs:justify-between">
                    {{ $layanan->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <dialog id="addModal"
        class="modal rounded-lg shadow-xl p-0 w-full max-w-md bg-white dark:bg-gray-800 backdrop:bg-gray-500/50">
        <div class="p-6">
            <h3 class="font-bold text-lg text-gray-900 dark:text-gray-100 mb-4">Tambah Layanan Baru</h3>
            <form method="POST" action="{{ route('admin.master.jenis_layanan.store') }}">
                @csrf
                <div class="mb-4">
                    <x-input-label for="nama_layanan" :value="__('Nama Layanan')" />
                    <x-text-input id="nama_layanan" class="block mt-1 w-full" type="text" name="nama_layanan"
                        required autofocus />
                </div>
                <div class="mb-4">
                    <label for="status_aktif" class="inline-flex items-center">
                        <input id="status_aktif" type="checkbox"
                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                            name="status_aktif" value="1" checked>
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Status Aktif') }}</span>
                    </label>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('addModal').close()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Batal</button>
                    <x-primary-button>Simpan</x-primary-button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Edit Modal (Simplified logic mainly for demo, normally use Livewire or separate page for cleaner edit) -->
    <dialog id="editModal"
        class="modal rounded-lg shadow-xl p-0 w-full max-w-md bg-white dark:bg-gray-800 backdrop:bg-gray-500/50">
        <div class="p-6">
            <h3 class="font-bold text-lg text-gray-900 dark:text-gray-100 mb-4">Edit Layanan</h3>
            <form id="editForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <x-input-label for="edit_nama_layanan" :value="__('Nama Layanan')" />
                    <x-text-input id="edit_nama_layanan" class="block mt-1 w-full" type="text" name="nama_layanan"
                        required />
                </div>
                <div class="mb-4">
                    <label for="edit_status_aktif" class="inline-flex items-center">
                        <input id="edit_status_aktif" type="checkbox"
                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                            name="status_aktif" value="1">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Status Aktif') }}</span>
                    </label>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('editModal').close()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Batal</button>
                    <x-primary-button>Simpan Perubahan</x-primary-button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        function openEditModal(id, name, status) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            const nameInput = document.getElementById('edit_nama_layanan');
            const statusInput = document.getElementById('edit_status_aktif');

            // Set Action URL
            form.action = "{{ route('admin.master.jenis_layanan.index') }}/" + id;

            // Set Values
            nameInput.value = name;
            statusInput.checked = status == 1;

            modal.showModal();
        }
    </script>
</x-admin-layout>
