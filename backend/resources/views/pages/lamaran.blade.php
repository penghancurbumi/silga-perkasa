<div class="flex flex-col">
    <div class="flex flex-col mb-3">
        <h1 class="text-2xl font-semibold">Kelola Lamaran</h1>
        <p class="text-xs text-gray-400 mt-1">Kelola seluruh lamaran dan pantau proses seleksi secara efisien dalam satu halaman.</p>
    </div> 

    <div class="flex flex-row gap-2">
        <div class="relative">
            <iconify-icon
                icon="material-symbols:search"
                width="20"
                class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"
            ></iconify-icon>

            <input  
                type="text"
                name="search"
                placeholder="cari pelamar..."
                class="w-64 bg-white rounded border border-gray-200 h-10 text-[12px] pl-10 pr-4"
            >
        </div>
            
        <div class="flex flex-row gap-2">

            <button class="inline-flex items-center gap-2 w-24 px-4 py-2 bg-white rounded border border-gray-200">

                <iconify-icon
                    icon="boxicons:filter"
                    width="15"
                ></iconify-icon>
                    Filter

            </button>

            
            <button class="inline-flex items-center gap-2 w-24 px-4 py-2 bg-white rounded border border-gray-200">

                <iconify-icon
                    icon="fluent-mdl2:sort-lines"
                    width="15"
                ></iconify-icon>
                    Sort

            </button>

            <button class="inline-flex items-center gap-2 w-32 px-4 py-2 bg-white rounded border border-gray-200">Reset</button>

        </div>
    </div>
</div>