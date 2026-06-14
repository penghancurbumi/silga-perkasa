<style>
    #sidebar {
        will-change: width;
    }
</style>

@persist('sidebar')
<aside
    id="sidebar"
    x-data="{
        expanded: $persist(true).as('sidebarExpanded'),
        lamaranOpen: false,

        toggle() {
            this.expanded = !this.expanded;
            if (!this.expanded) this.lamaranOpen = false;
            window.dispatchEvent(new CustomEvent('sidebarToggle'));
        },

        expand() {
            this.expanded = true;
            window.dispatchEvent(new CustomEvent('sidebarToggle'));
        },

        toggleLamaran() {
            if (!this.expanded) {
                this.expand();
                this.$nextTick(() => { this.lamaranOpen = true; });
            } else {
                this.lamaranOpen = !this.lamaranOpen;
            }
        }
    }"
    :class="expanded ? 'w-64' : 'w-20'"
    class="h-screen min-h-screen min-w-[80px]
           bg-gray-900 text-white
           px-3 py-6
           transition-[width] duration-300
           overflow-hidden
           flex flex-col shrink-0"
>

    {{-- HEADER --}}
    <div class="relative flex items-center mb-8 px-2 min-h-[40px]">

        {{-- Logo Besar (expanded) --}}
        <img
            x-show="expanded"
            x-cloak
            src="{{ asset('images/collapse.png') }}"
            alt="logo"
            style="width:150px"
            class="h-auto"
        >

        {{-- Logo Kecil (collapsed, klik untuk expand) --}}
        <img
            x-show="!expanded"
            x-cloak
            @click="expand()"
            src="{{ asset('images/expand-logo.png') }}"
            alt="logo"
            style="width:40px"
            class="h-auto cursor-pointer"
        >

        {{-- Toggle button (hanya saat expanded) --}}
        <button
            x-show="expanded"
            x-cloak
            @click="toggle()"
            class="ml-auto flex-shrink-0"
        >
            <iconify-icon
                icon="lucide:sidebar"
                width="20"
                class="cursor-pointer"
            ></iconify-icon>
        </button>

    </div>

    {{-- NAVIGATION --}}
    <nav class="flex-1 overflow-y-auto">

        <ul class="space-y-2">

            {{-- DASHBOARD --}}
            <li>
                <a
                    href="{{ route('dashboard') }}"
                    wire:navigate
                    class="nav-link flex items-center
                           px-3 gap-3 rounded
                           py-2 font-semibold text-[15px]
                           transition-colors duration-200
                    {{ request()->routeIs('dashboard')
                        ? 'bg-white text-black'
                        : 'text-white hover:bg-[#1f2733]' }}"
                >
                    <iconify-icon
                        icon="material-symbols:dashboard"
                        width="25"
                        class="flex-shrink-0"
                    ></iconify-icon>

                    <span x-show="expanded" x-cloak class="sidebar-text">
                        Dashboard
                    </span>
                </a>
            </li>

            {{-- CONTENT --}}
            <li>
                <a
                    href="{{ route('content') }}"
                    wire:navigate
                    class="nav-link flex items-center
                           px-3 gap-3 rounded
                           py-2 font-semibold text-[15px]
                           transition-colors duration-200
                    {{ request()->routeIs('content')
                        ? 'bg-white text-black'
                        : 'text-white hover:bg-[#1f2733]' }}"
                >
                    <iconify-icon
                        icon="wordpress:post-content"
                        width="25"
                        class="flex-shrink-0"
                    ></iconify-icon>

                    <span x-show="expanded" x-cloak class="sidebar-text">
                        Content
                    </span>
                </a>
            </li>

            {{-- LOWONGAN --}}
            <li>
                <a
                    href="{{ route('lowongan') }}"
                    wire:navigate
                    class="nav-link flex items-center
                           px-3 gap-3 rounded
                           py-2 font-semibold text-[15px]
                           transition-colors duration-200
                    {{ request()->routeIs('lowongan*')
                        ? 'bg-white text-black'
                        : 'text-white hover:bg-[#1f2733]' }}"
                >
                    <iconify-icon
                        icon="eos-icons:job"
                        width="25"
                        class="flex-shrink-0"
                    ></iconify-icon>

                    <span x-show="expanded" x-cloak class="sidebar-text">
                        Lowongan
                    </span>
                </a>
            </li>

            {{-- LAMARAN --}}
            <li>
                <button
                    type="button"
                    @click="toggleLamaran()"
                    class="flex items-center w-full
                           px-3 gap-3 rounded
                           py-2 font-semibold text-[15px]
                           text-white hover:bg-[#1f2733]
                           transition-colors duration-200"
                >
                    <iconify-icon
                        icon="iconamoon:profile-fill"
                        width="25"
                        class="flex-shrink-0"
                    ></iconify-icon>

                    <span x-show="expanded" x-cloak class="sidebar-text">
                        Lamaran
                    </span>

                    <iconify-icon
                        x-show="expanded"
                        x-cloak
                        icon="fe:arrow-up"
                        width="20"
                        :class="lamaranOpen ? 'rotate-180' : ''"
                        class="ml-auto transition-transform duration-200"
                    ></iconify-icon>
                </button>

                {{-- SUBMENU Lamaran --}}
                <ul
                    x-show="lamaranOpen && expanded"
                    x-cloak
                    x-transition:enter="transition-all duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="py-2 space-y-2 ml-7 border-l border-gray-800"
                >
                    <li>
                        <a
                            href="#"
                            class="flex items-center w-full pl-4 gap-2 p-2 rounded
                                   font-semibold text-gray-400 hover:bg-[#1f2733]"
                        >
                            <span class="sidebar-text">Lamaran Masuk</span>
                        </a>
                    </li>

                    <li>
                        <a
                            href="#"
                            class="flex items-center w-full pl-4 gap-2 p-2 rounded
                                   font-semibold text-gray-400 hover:bg-[#1f2733]"
                        >
                            <span class="sidebar-text">Kelola Lamaran</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- SETTINGS --}}
            <li>
                <a
                    href="{{ route('settings') }}"
                    wire:navigate
                    class="nav-link flex items-center
                           px-3 gap-3 rounded
                           py-2 font-semibold text-[15px]
                           transition-colors duration-200
                    {{ request()->routeIs('settings*')
                        ? 'bg-white text-black'
                        : 'text-white hover:bg-[#1f2733]' }}"
                >
                    <iconify-icon
                        icon="ep:setting"
                        width="25"
                        class="flex-shrink-0"
                    ></iconify-icon>

                    <span x-show="expanded" x-cloak class="sidebar-text">
                        Settings
                    </span>
                </a>
            </li>

        </ul>

    </nav>

</aside>
@endpersist
