<nav class="bg-white shadow px-6 py-2 flex items-center justify-between">

    {{-- Left --}}
    <div class="flex flex-row items-center gap-1">

        <iconify-icon
            icon="material-symbols:dashboard"
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

        <span class="text-sm font-semibold text-black">Dashboard</span>
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
        

        <div class="relative flex w-8 h-8 items-center justify-center rounded-lg hover:bg-gray-200 cursor-pointer text-gray-500 hover:text-gray-900 transition" >
            <iconify-icon
                icon="iconamoon:notification"
                width="18">
            </iconify-icon>
        </div>

        <div class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-200 cursor-pointer text-gray-500 hover:text-gray-900 transition">
            <iconify-icon
                icon="mi:message"
                width="18">
            </iconify-icon>
        </div>

        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 text-[12px] font-semibold cursor-pointer">
            A
        </div>
    </div>

</nav>