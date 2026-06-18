<nav class="bg-white border-b border-gray-200 px-6 py-2 flex items-center justify-between">
@php
    $pageMap = [
        'dashboard'  => ['label' => 'Dashboard',  'icon' => 'material-symbols:dashboard'],
        'content'    => ['label' => 'Content',     'icon' => 'wordpress:post-content'],
        'lowongan*'  => ['label' => 'Lowongan',    'icon' => 'eos-icons:job'],
        'settings*'  => ['label' => 'Settings',    'icon' => 'ep:setting'],
    ];

    $currentLabel = 'Dashboard';
    $currentIcon  = 'material-symbols:dashboard';

    foreach ($pageMap as $route => $page) {
        if (request()->routeIs($route)) {
            $currentLabel = $page['label'];
            $currentIcon  = $page['icon'];
            break;
        }
    }
@endphp

    {{-- Left --}}
    <div class="flex flex-row items-center gap-1">

        <iconify-icon
            icon="{{ $currentIcon }}"
            width="20"
            class="text-gray-400">
        </iconify-icon>

        <h1 class="text-sm font-semibold text-gray-400">
            Overview
        </h1>

        <iconify-icon 
            icon="iconoir:slash"
            width="15" height="15"
            class="text-gray-400">
        </iconify-icon>

        <span class="text-sm font-semibold text-black">{{ $currentLabel }}</span>
    </div>

    {{-- Right--}}
    <div class="flex items-center gap-3">

        <div class="flex items-center gap-2 border border-gray-400 rounded-sm px-4 py-1 bg-transparent">
            <iconify-icon
                icon="material-symbols:search"
                width="15"
                class="flex-shrink-0">
            </iconify-icon>

            <input 
                type="text"
                placeholder="Search here"
                class="bg-transparent text-[12px] outline-none text-gray-700 placeholder-gray-400 w-40"
            />
        </div>
        
        <livewire:notification-bell/>
        
        <x-profile />
    </div>

</nav>