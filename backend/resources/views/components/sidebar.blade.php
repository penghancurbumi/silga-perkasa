<style>
    #sidebar {
        will-change: width;
    }

    .sidebar-text {
        white-space: nowrap;
    }
</style>

@persist('sidebar')
<aside
    id="sidebar"
    class="w-64 h-screen min-h-screen min-w-[80px]
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
            id="logoExpanded"
            src="{{ asset('images/collapse.png') }}"
            alt="logo"
            style="width:150px"
            class="h-auto"
        >

        {{-- Logo Kecil --}}
        <img
            id="logoCollapsed"
            src="{{ asset('images/expand-logo.png') }}"
            alt="logo"
            style="width:40px"
            class="h-auto hidden cursor-pointer"
        >

        {{-- Toggle --}}
        <button
            id="toggleSidebar"
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

                    @if(request()->routeIs('dashboard'))
                        onclick="return false"
                    @endif
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

                    <span class="sidebar-text transition-all duration-200">
                        Dashboard
                    </span>

                </a>
            </li>

            {{-- CONTENT --}}
            <li>
                <a
                    href="{{ route('content') }}"
                    @if(request()->routeIs('content'))
                        onclick="return false"
                    @endif
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

                    <span class="sidebar-text transition-all duration-200">
                        Content
                    </span>

                </a>
            </li>

            {{-- LOWONGAN --}}
            <li>
                <a
                    href="{{ route('lowongan') }}"
                    @if(request()->routeIs('lowongan'))
                        onclick="return false"
                    @endif
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

                    <span class="sidebar-text transition-all duration-200">
                        Lowongan
                    </span>

                </a>
            </li>

            {{-- Lamaran --}}
            <li class="dropdown-wrapper">
                <button
                    type="button"

                    class="dropdown-button nav-link flex items-center
                           w-full px-3 gap-3 rounded
                           py-2 font-semibold text-[15px]
                           hover:bg-[#1f2733]
                           transition-colors duration-200"
                >

                    <iconify-icon
                        icon="iconamoon:profile-fill"
                        width="25"
                        class="flex-shrink-0"
                    ></iconify-icon>

                    <span class="sidebar-text transition-all duration-200">
                        Lamaran
                    </span>

                    <iconify-icon
                        icon="fe:arrow-up"
                        width="20"
                        class="dropdown-arrow ml-auto transition-transform duration-200"
                    ></iconify-icon>

                </button>

                {{-- SUBMENU --}}
                <ul
                    class="dropdown-menu py-2 space-y-2 ml-7 border-l border-gray-800 hidden"
                >

                    <li>
                        <a
                            href="#"
                            class="flex items-center
                                   w-full pl-4 gap-2
                                   p-2 rounded
                                   font-semibold text-gray-400
                                   hover:bg-[#1f2733]"
                        >

                            <span class="sidebar-text">
                                Lamaran Masuk
                            </span>

                        </a>
                    </li>

                    <li>
                        <a
                            href="#"
                            class="flex items-center
                                   w-full pl-4 gap-2
                                   p-2 rounded
                                   font-semibold text-gray-400
                                   hover:bg-[#1f2733]"
                        >
                            <span class="sidebar-text">
                                Kelola Lamaran
                            </span>

                        </a>
                    </li>

                </ul>

            </li>

            {{-- SETTINGS --}}
            <li>
                <a
                    href="{{ route('settings') }}"
                    @if(request()->routeIs('settings'))
                        onclick="return false"
                    @endif
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

                    <span class="sidebar-text transition-all duration-200">
                        Settings
                    </span>

                </a>
            </li>

        </ul>

    </nav>

</aside>
@endpersist
