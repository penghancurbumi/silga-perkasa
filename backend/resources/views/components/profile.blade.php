<div class="relative" x-data="{ open: false }" @click.outside="open = false">

    {{-- Profile Avatar Button --}}
    <button @click="open = !open" class="flex items-center focus:outline-none cursor-pointer">
        @if (Auth::user()->avatar)
            <img src="{{ Storage::url(Auth::user()->avatar) }}" 
                 alt="Avatar" 
                 class="w-8 h-8 rounded-full object-cover border border-gray-200 hover:opacity-80 transition">
        @else
            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 text-[12px] font-semibold uppercase hover:bg-blue-200 transition">
                {{ substr(Auth::user()->email, 0, 1) }}
            </div>
        @endif
    </button>

    <div x-show="open" x-cloak x-transition
        class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-xl shadow-xl z-50 overflow-hidden py-1">

        <div class="px-4 py-2 border-b border-gray-100 bg-white">

            <div class="flex flex-row gap-2 items-center">
                @if (Auth::user()->avatar)
                    <img src="{{ Storage::url(Auth::user()->avatar) }}" 
                         alt="Avatar" 
                         class="w-8 h-8 rounded-full object-cover border border-gray-200">
                @else
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 text-[12px] font-semibold uppercase">
                        {{ substr(Auth::user()->email, 0, 1) }}
                    </div>
                @endif

                <div class="flex flex-col">
                    <p class="text-[12px] font-semibold text-gray-800 truncate">
                        {{ Auth::user()->name ?: 'User' }}
                    </p>
                    <p class="text-[10px] text-gray-400 truncate">
                        {{ Auth::user()->email }}
                    </p>
                </div>
            </div>   
        </div>

        <a href="{{ route('profile') }}" wire:navigate class="flex items-center gap-2 px-4 py-2 text-[12px] text-gray-700 hover:bg-gray-50 transition font-medium">
            <iconify-icon icon="iconamoon:profile" width="18"></iconify-icon> Profile
        </a>
       
        <a href="{{ route('settings') }}" wire:navigate class="flex items-center gap-2 px-4 py-2 text-[12px] text-gray-700 hover:bg-gray-50 transition font-medium">
            <iconify-icon icon="iconamoon:settings" width="18"></iconify-icon> Settings
        </a>
        
        <form method="POST" action="{{ route('logout') }}" id="logout-form" class="hidden">
            @csrf
        </form>
        
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
           class="flex items-center gap-2 px-4 py-2 text-[12px] text-gray-700 hover:bg-gray-50 hover:text-gray-700 transition font-medium">
            <iconify-icon icon="material-symbols:logout" width="18"></iconify-icon> Logout
        </a>
    </div>
</div>
