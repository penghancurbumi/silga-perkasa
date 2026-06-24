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

        toggle() {
            this.expanded = !this.expanded;
            window.dispatchEvent(new CustomEvent('sidebarToggle'));
        },

        expand() {
            this.expanded = true;
            window.dispatchEvent(new CustomEvent('sidebarToggle'));
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

        {{-- Logo Besar --}}
        <img
            x-show="expanded"
            x-transition
            x-cloak
            src="{{ asset('images/collapse.png') }}"
            alt="logo"
            style="width:150px"
            class="h-auto"
        >

        {{-- Logo Kecil --}}
        <img
            x-show="!expanded"
            x-transition
            x-cloak
            @click="expand()"
            src="{{ asset('images/expand-logo.png') }}"
            alt="logo"
            style="width:40px"
            class="h-auto cursor-pointer"
        >

        {{-- Toggle --}}
        <button
            x-show="expanded"
            x-transition
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
                    class="nav-link flex items-center px-3 gap-3 rounded py-2 font-semibold text-[15px] transition-colors duration-200 text-white hover:bg-[#1f2733]"
                >
                    <iconify-icon
                        icon="material-symbols:dashboard"
                        width="25"
                        class="flex-shrink-0"
                    ></iconify-icon>

                    <span x-show="expanded" x-transition x-cloak>
                        Dashboard
                    </span>
                </a>
            </li>

            {{-- CONTENT --}}
            <li>
                <a
                    href="{{ route('content') }}"
                    wire:navigate
                    class="nav-link flex items-center px-3 gap-3 rounded py-2 font-semibold text-[15px] transition-colors duration-200 text-white hover:bg-[#1f2733]"
                >
                    <iconify-icon
                        icon="wordpress:post-content"
                        width="25"
                        class="flex-shrink-0"
                    ></iconify-icon>

                    <span x-show="expanded" x-transition x-cloak>
                        Content
                    </span>
                </a>
            </li>

            {{-- LOWONGAN --}}
            <li>
                <a
                    href="{{ route('lowongan') }}"
                    wire:navigate
                    class="nav-link flex items-center px-3 gap-3 rounded py-2 font-semibold text-[15px] transition-colors duration-200 text-white hover:bg-[#1f2733]"
                >
                    <iconify-icon
                        icon="eos-icons:job"
                        width="25"
                        class="flex-shrink-0"
                    ></iconify-icon>

                    <span x-show="expanded" x-transition x-cloak>
                        Lowongan
                    </span>
                </a>
            </li>

            {{-- LAMARAN --}}
            <li>
                <a
                    href="{{ route('lamaran') }}"
                    wire:navigate
                    class="nav-link flex items-center px-3 gap-3 rounded py-2 font-semibold text-[15px] transition-colors duration-200 text-white hover:bg-[#1f2733]"
                >
                    <iconify-icon
                        icon="material-symbols:work-outline"
                        width="25"
                        class="flex-shrink-0"
                    ></iconify-icon>

                    <span x-show="expanded" x-transition x-cloak>
                        Lamaran
                    </span>
                </a>
            </li>

            {{-- ACTIVITY --}}
            <li>
                <a
                    href="{{ route('activity') }}"
                    wire:navigate
                    class="nav-link flex items-center px-3 gap-3 rounded py-2 font-semibold text-[15px] transition-colors duration-200 text-white hover:bg-[#1f2733]"
                >
                    <iconify-icon
                        icon="mynaui:activity-solid"
                        width="25"
                        class="flex-shrink-0"
                    ></iconify-icon>

                    <span x-show="expanded" x-transition x-cloak>
                        Activity
                    </span>
                </a>
            </li>

            {{-- SETTINGS --}}
            <li>
                <a
                    href="{{ route('settings') }}"
                    wire:navigate
                    class="nav-link flex items-center px-3 gap-3 rounded py-2 font-semibold text-[15px] transition-colors duration-200 text-white hover:bg-[#1f2733]"
                >
                    <iconify-icon
                        icon="ep:setting"
                        width="25"
                        class="flex-shrink-0"
                    ></iconify-icon>

                    <span x-show="expanded" x-transition x-cloak>
                        Settings
                    </span>
                </a>
            </li>

        </ul>

    </nav>

</aside>
@endpersist