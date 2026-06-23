@props(['lowongan'])

<div class="relative" x-data="{ open: false }" @click.outside="open = false">

    {{-- Kebab Button --}}
    <button @click="open = !open"
        class="flex items-center justify-center w-6 h-6 rounded hover:bg-gray-100 cursor-pointer text-gray-400 hover:text-gray-700 transition">
        <iconify-icon icon="ri:more-line" width="20"></iconify-icon>
    </button>

    {{-- Dropdown Menu --}}
    <div x-show="open" x-cloak x-transition
        class="absolute right-0 mt-1 w-36 bg-white border border-gray-200 rounded-lg shadow-lg z-50 overflow-hidden">
        <ul class="py-1">
            <li>
                <a href="{{ route('lowongan.edit', $lowongan->id) }}" wire:navigate
                    class="flex items-center gap-2 px-4 py-2 text-[12px] text-gray-700 hover:bg-gray-50 transition">
                    <iconify-icon icon="material-symbols:edit-outline" width="14"></iconify-icon>
                    Edit
                </a>
            </li>
            <li>
                <a href="{{ route('lowongan.destroy', $lowongan->id)}}" wire:navigate
                    onclick="return confim('yakin mau menghapus')"
                    class="flex items-center gap-2 px-4 py-2 text-[12px] text-red-500 hover:bg-red-50 transition">
                    <iconify-icon icon="material-symbols:delete-outline" width="14"></iconify-icon>
                    Hapus
                </a>
            </li>
        </ul>
    </div>

</div>
