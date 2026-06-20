<div>
    <h1 class="text-2xl font-semibold">Profile</h1>

    <!-- alert profile -->
    <div id="alert-profile" class="hidden absolute top-15 right-5 bg-white p-4 rounded-lg border border-gray-200 shadow z-50">
        <div class="flex flex-row space-x-3">
            <iconify-icon 
                icon="mdi:tick"
                width="15"
                class="text-green-500 border border-gray-200 p-2 rounded-lg bg-green-100"
            ></iconify-icon>

            <div class="flex flex-col">
                <p class="text-[12px] font-semibold">Profile Saved</p>
                <p class="text-[10px] font-semibold text-gray-400">Your profile settings have been successfully updated.</p>
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
        <form wire:submit.prevent="save" class="flex flex-col gap-6">
            <div class="flex flex-col">
                <h3 class="text-base font-medium text-gray-900">Account Settings</h3>
                <p class="text-xs text-gray-500">Kelola informasi akun Anda di sini.</p>
            </div>

            <div class="flex flex-col gap-2">
                <div>
                    <span class="text-[15px] font-semibold block text-gray-800">Avatar</span>
                    <p class="text-[12px] text-gray-400">Pilih gambar profil Anda (Maksimal 2MB).</p>
                </div>

                <div class="flex items-center gap-4 py-2 border-b border-gray-100 pb-4">
                    <div class="relative">
                        @if ($avatar)
                            <img src="{{ $avatar->temporaryUrl() }}" class="w-20 h-20 rounded-full object-cover border border-gray-200">
                        @elseif ($existingAvatar)
                            <img src="{{ Storage::url($existingAvatar) }}" class="w-20 h-20 rounded-full object-cover border border-gray-200">
                        @else
                            <div class="w-20 h-20 rounded-full bg-neutral-100 border border-gray-200 flex items-center justify-center text-neutral-700 font-bold text-lg">
                                {{ strtoupper(substr(Auth::user()->email, 0, 2)) }}
                            </div>
                        @endif

                        <label for="avatarInput" class="absolute bottom-0 right-0 bg-black text-white p-1.5 rounded-full cursor-pointer hover:bg-neutral-800 border border-white transition flex items-center justify-center">
                            <iconify-icon icon="material-symbols:edit-outline" width="16"></iconify-icon>
                        </label>
                        <input type="file" id="avatarInput" wire:model.live="avatar" accept="image/*" class="hidden" wire:key="avatar-input-{{ $avatar ? 'has-file' : 'no-file' }}-{{ $existingAvatar }}">
                    </div>

                    {{-- Tombol Hapus Avatar --}}
                    @if ($avatar || $existingAvatar)
                        <button 
                            type="button" 
                            wire:click="deleteAvatar" 
                            class="text-xs text-red-500 hover:text-red-600 font-semibold flex items-center gap-1 cursor-pointer transition border border-red-200 rounded px-2.5 py-1.5 bg-red-50 hover:bg-red-100">
                            <iconify-icon icon="material-symbols:delete-outline" width="16"></iconify-icon>
                            Hapus Foto
                        </button>
                    @endif
                </div>
                @error('avatar')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror

                <div class="flex flex-col gap-2">
                    <span class="text-[14px] font-semibold text-gray-700">Name</span>
                    <input
                        type="text"
                        wire:model.live="name"
                        placeholder="Masukkan nama..."
                        class="max-w-md w-full border rounded px-4 py-2 text-sm transition duration-150 outline-none
                        {{ $errors->has('name') ? 'border-red-500 focus:border-red-500 focus:ring-1 focus:ring-red-500' : 'border-gray-300 focus:border-black focus:ring-1 focus:ring-black' }}">
                    @error('name')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <span class="text-[14px] font-semibold text-gray-700">Email</span>
                    <input 
                        type="email" 
                        wire:model.live="email"
                        placeholder="Masukkan email..."
                        class="max-w-md w-full border rounded px-4 py-2 text-sm transition duration-150 outline-none
                        {{ $errors->has('email') ? 'border-red-500 focus:border-red-500 focus:ring-1 focus:ring-red-500' : 'border-gray-300 focus:border-black focus:ring-1 focus:ring-black' }}">
                    @error('email')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <span class="text-[14px] font-semibold text-gray-700">Password</span>
                    
                    <div x-data="{ show: false }" class="relative flex items-center max-w-md w-full">
                        <input 
                            :type="show ? 'text' : 'password'"
                            wire:model.live="password"
                            autocomplete="new-password"
                            placeholder="••••••••"
                            class="w-full border rounded pl-4 pr-10 py-2 text-sm transition duration-150 outline-none
                            {{ $errors->has('password') ? 'border-red-500 focus:border-red-500 focus:ring-1 focus:ring-red-500' : 'border-gray-300 focus:border-black focus:ring-1 focus:ring-black' }}">

                        <button
                            type="button"
                            @click="show = !show"
                            class="absolute right-3 text-gray-500 cursor-pointer flex items-center justify-center">

                            <iconify-icon
                                x-show="!show"
                                icon="mdi:eye-outline"
                                width="20"    
                            ></iconify-icon>

                            <iconify-icon
                                x-show="show"
                                icon="mdi:eye-off-outline"
                                width="20"
                                style="display: none;"
                            ></iconify-icon>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
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
