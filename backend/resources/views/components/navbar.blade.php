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

        <div x-data="{ 
            search: '', 
            open: false,
            history: JSON.parse(localStorage.getItem('search_history') || '[]'),
            pages: [
                { name: 'Dashboard', url: '{{ route('dashboard') }}', icon: 'material-symbols:dashboard' },
                { name: 'Content List', url: '{{ route('content') }}', icon: 'wordpress:post-content' },
                { name: 'Create Content', url: '{{ route('content.create') }}', icon: 'material-symbols:add' },
                { name: 'Lowongan Jobs', url: '{{ route('lowongan') }}', icon: 'eos-icons:job' },
                { name: 'Lamaran Applications', url: '{{ route('lamaran') }}', icon: 'material-symbols:work' },
                { name: 'Settings', url: '{{ route('settings') }}', icon: 'ep:setting' },
                { name: 'Profile', url: '{{ route('profile') }}', icon: 'material-symbols:person' },
                { name: 'Activity Log', url: '{{ route('activity') }}', icon: 'material-symbols:history' }
            ],
            get filteredPages() {
                if (this.search === '') return [];
                return this.pages.filter(page => page.name.toLowerCase().includes(this.search.toLowerCase()));
            },
            get historyPages() {
                return this.history
                    .map(name => this.pages.find(page => page.name === name))
                    .filter(page => page !== undefined);
            },
            addToHistory(pageName) {
                this.history = this.history.filter(item => item !== pageName);
                this.history.unshift(pageName);
                this.history = this.history.slice(0, 5);
                localStorage.setItem('search_history', JSON.stringify(this.history));
            },
            clearHistory() {
                this.history = [];
                localStorage.removeItem('search_history');
            }
        }" @click.outside="open = false" class="relative">

            <div class="flex items-center gap-2 border border-gray-400 rounded-sm px-4 py-1 bg-transparent">
                <iconify-icon
                    icon="material-symbols:search"
                    width="15"
                    class="flex-shrink-0">
                </iconify-icon>

                <input 
                    type="text"
                    x-model="search"
                    @focus="open = true"
                    @click="open = true"
                    @keydown.escape.window="open = false"
                    placeholder="Search here..."
                    class="bg-transparent text-[12px] outline-none text-gray-700 placeholder-gray-400 w-40"
                />
            </div>

            <!-- Dropdown Menu -->
            <div 
                x-show="open" 
                x-cloak
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute right-0 top-full mt-2 w-64 bg-white border border-gray-200 shadow-lg rounded-md overflow-hidden z-50">
                
                <div class="max-h-64 overflow-y-auto">
                    
                    <!-- View History (if search is empty) -->
                    <div x-show="search === ''">
                        <template x-if="history.length > 0">
                            <div>
                                <div class="px-4 py-2 text-[10px] font-semibold text-gray-400 uppercase tracking-wider bg-gray-50 flex items-center justify-between border-b border-gray-100">
                                    <span>Recent History</span>
                                    <button @click.prevent.stop="clearHistory()" class="text-red-500 hover:text-red-700 normal-case font-medium text-[10px] transition-colors">Hapus</button>
                                </div>
                                <template x-for="page in historyPages" :key="page.name">
                                    <a :href="page.url" @click="addToHistory(page.name)" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-50 border-b border-gray-100 last:border-0 transition-colors">
                                        <iconify-icon icon="material-symbols:history" class="text-gray-400"></iconify-icon>
                                        <span x-text="page.name" class="text-sm text-gray-700"></span>
                                    </a>
                                </template>
                            </div>
                        </template>
                        <template x-if="history.length === 0">
                            <div class="px-4 py-5 text-xs text-gray-400 text-center flex flex-col items-center gap-1.5">
                                <iconify-icon icon="material-symbols:search" width="20" class="text-gray-300"></iconify-icon>
                                <span class="font-medium text-gray-500">Belum ada riwayat pencarian.</span>
                                <span class="text-[10px] text-gray-400 leading-none">Ketik untuk mencari halaman...</span>
                            </div>
                        </template>
                    </div>

                    <!-- Search Results (if search is not empty) -->
                    <div x-show="search !== ''">
                        <div class="px-4 py-2 text-[10px] font-semibold text-gray-400 uppercase tracking-wider bg-gray-50 border-b border-gray-100">
                            Search Results
                        </div>
                        <template x-for="page in filteredPages" :key="page.name">
                            <a :href="page.url" @click="addToHistory(page.name)" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-50 border-b border-gray-100 last:border-0 transition-colors">
                                <iconify-icon :icon="page.icon" class="text-gray-500"></iconify-icon>
                                <span x-text="page.name" class="text-sm text-gray-700"></span>
                            </a>
                        </template>
                        <div x-show="filteredPages.length === 0" class="px-4 py-4 text-xs text-gray-500 text-center flex flex-col items-center gap-1.5">
                            <iconify-icon icon="material-symbols:info-outline" width="20" class="text-gray-300"></iconify-icon>
                            <span>Halaman tidak ditemukan.</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        
        <livewire:notification-bell/>
        
        <x-profile />
    </div>

</nav>