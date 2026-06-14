<div class="relative" x-data="{ open: false }" @click.outside="open = false">

    {{-- Bell Button --}}
    <button @click="open = !open"
        class="relative flex w-8 h-8 items-center justify-center rounded-lg hover:bg-gray-200 cursor-pointer text-gray-500 hover:text-gray-900 transition">

        <iconify-icon icon="iconamoon:notification" width="18"></iconify-icon>

        @if ($unreadCount > 0)
            <span class="absolute top-0.5 right-0.5 w-4 h-4 bg-red-500 text-white text-[9px] font-bold rounded-full flex items-center justify-center">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>
        @endif
    </button>

    {{-- Dropdown Panel --}}
    <div x-show="open" x-cloak x-transition
        class="absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-xl shadow-xl z-50 overflow-hidden">

        {{-- Header --}}
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
            <span class="text-[13px] font-semibold text-gray-800">Notifikasi</span>
            @if ($unreadCount > 0)
                <button wire:click="markAllRead"
                    class="text-[11px] text-blue-500 hover:underline cursor-pointer">
                    Tandai semua dibaca
                </button>
            @endif
        </div>

        {{-- List --}}
        <ul class="max-h-72 overflow-y-auto divide-y divide-gray-100">
            @forelse ($notifications as $notif)
                <li wire:key="{{ $notif->id }}"
                    class="px-4 py-3 hover:bg-gray-50 transition cursor-pointer {{ is_null($notif->read_at) ? 'bg-blue-50' : '' }}"
                    wire:click="markRead('{{ $notif->id }}')">

                    <p class="text-[12px] text-gray-800 font-medium">
                        {{ $notif->data['message'] ?? '-' }}
                    </p>
                    <span class="text-[10px] text-gray-400">
                        {{ $notif->created_at->diffForHumans() }}
                    </span>
                </li>
            @empty
                <li class="px-4 py-6 text-center text-[12px] text-gray-400">
                    Tidak ada notifikasi
                </li>
            @endforelse
        </ul>
    </div>
</div>
