<div>
    <h1 class="text-2xl font-semibold">Setting</h1>
    <span class="text-[13px] text-gray-400">Kelola konfigurasi dan preferensi aplikasi Anda di sini.</span>

    <!-- alert settings -->
    <div id="alert-settings" class="hidden absolute top-15 right-5 bg-white p-4 rounded-lg border border-gray-200 shadow z-50">
        <div class="flex flex-row space-x-3">
            <iconify-icon 
                icon="mdi:tick"
                width="15"
                class="text-green-500 border border-gray-200 p-2 rounded-lg bg-green-100"
            ></iconify-icon>

            <div class="flex flex-col">
                <p class="text-[12px] font-semibold">Settings Saved</p>
                <p class="text-[10px] font-semibold text-gray-400">Your preferences have been successfully updated.</p>
            </div>

            <button onclick="closeAlert()" class="self-start -mt-1 cursor-pointer text-gray-500 hover:text-gray-400">
                <iconify-icon
                    icon="gridicons:cross"
                    width="15"
                ></iconify-icon>
            </button>
        </div>
    </div>

    <div class="mt-4 bg-white p-6 rounded-lg border border-gray-200 shadow-sm relative">
        <form wire:submit.prevent="save" class="flex flex-col gap-4">
            
            {{-- Section 1: Regional --}}
            <div class="flex flex-col gap-4">
                <div class="border-b border-gray-100 pb-2">
                    <h3 class="text-sm font-semibold text-gray-900">Regional</h3>
                    <p class="text-xs text-gray-500">Sesuaikan zona waktu Anda.</p>
                </div>

                {{-- Zona Waktu --}}
                <div class="flex flex-col gap-2">
                    <span class="text-[14px] font-semibold text-gray-700">Zona Waktu</span>
                    <div class="relative max-w-md w-full">
                        <select wire:model.live="timezone" class="w-full border border-gray-300 rounded pl-4 pr-10 py-2 text-sm outline-none focus:border-black focus:ring-1 focus:ring-black appearance-none bg-white cursor-pointer">
                            <option value="Asia/Jakarta">WIB (Asia/Jakarta - UTC+7)</option>
                            <option value="Asia/Makassar">WITA (Asia/Makassar - UTC+8)</option>
                            <option value="Asia/Jayapura">WIT (Asia/Jayapura - UTC+9)</option>
                            <option value="UTC">UTC</option>
                        </select>
                        <iconify-icon icon="mdi:chevron-down" width="16" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></iconify-icon>
                    </div>
                    @error('timezone')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Section 2: Preferensi Konten --}}
            <div class="flex flex-col gap-4">
                <div class="border-b border-gray-100 pb-2">
                    <h3 class="text-sm font-semibold text-gray-900">Preferensi Konten</h3>
                    <p class="text-xs text-gray-500">Sesuaikan tampilan daftar data dan tabel.</p>
                </div>

                <div class="flex flex-col gap-2">
                    <span class="text-[14px] font-semibold text-gray-700">Jumlah Data Per Halaman</span>
                    <div class="relative max-w-md w-full">
                        <select wire:model.live="pagination_limit" class="w-full border border-gray-300 rounded pl-4 pr-10 py-2 text-sm outline-none focus:border-black focus:ring-1 focus:ring-black appearance-none bg-white cursor-pointer">
                            <option value="">Normal</option>
                            <option value="5">5 baris</option>
                            <option value="10">10 baris</option>
                            <option value="12">12 baris</option>
                            <option value="15">15 baris</option>
                            <option value="20">20 baris</option>
                            <option value="25">25 baris</option>
                        </select>
                        <iconify-icon icon="mdi:chevron-down" width="16" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></iconify-icon>
                    </div>
                    @error('pagination_limit')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Section 3: Pengaturan Notifikasi --}}
            <div class="flex flex-col gap-4">
                <div class="border-b border-gray-100 pb-2">
                    <h3 class="text-sm font-semibold text-gray-900">Pengaturan Notifikasi</h3>
                    <p class="text-xs text-gray-500">Pilih notifikasi yang ingin Anda tampilkan pada menu lonceng.</p>
                </div>

                <div class="flex flex-col gap-3">
                    {{-- Notif Login --}}
                    <label class="flex items-start gap-3 cursor-pointer select-none">
                        <input type="checkbox" wire:model.live="notif_login" class="mt-1 accent-black h-4 w-4 rounded border-gray-300">
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-gray-800">Aktivitas Login</span>
                            <span class="text-xs text-gray-400">Beri tahu saya di lonceng notifikasi setiap ada sesi login baru di akun saya.</span>
                        </div>
                    </label>

                    {{-- Notif Publish --}}
                    <label class="flex items-start gap-3 cursor-pointer select-none mt-1">
                        <input type="checkbox" wire:model.live="notif_publish" class="mt-1 accent-black h-4 w-4 rounded border-gray-300">
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-gray-800">Penerbitan Artikel</span>
                            <span class="text-xs text-gray-400">Beri tahu saya di lonceng notifikasi ketika artikel terjadwal (scheduled post) berhasil diterbitkan.</span>
                        </div>
                    </label>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex justify-end gap-3 mt-4 pt-4 border-t border-gray-100">
                <button 
                    type="submit" 
                    wire:loading.attr="disabled"
                    @disabled(!$this->isDirty())
                    class="bg-black hover:bg-neutral-800 text-white font-semibold text-sm px-6 py-2.5 rounded cursor-pointer transition flex items-center justify-center min-w-[140px] disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="save">Simpan Perubahan</span>
                    <span wire:loading wire:target="save" class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Menyimpan...
                    </span>
                </button>
            </div>

        </form>
    </div>
</div>
