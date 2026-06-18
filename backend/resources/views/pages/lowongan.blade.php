<div class="flex flex-col gap-4">
    <div class="flex flex-row items-center justify-between mb-2">

        <div class="flex flex-col">
            <h1 class="text-2xl font-semibold">Lowongan</h1>
            <p class="text-xs text-gray-400 mt-1">Manage job postings and monitor active recruitment opportunities.</p>
        </div>

        <div class="flex items-center gap-2">

            <a 
                class="inline-flex items-center px-4 py-2 rounded gap-2 bg-white text-black hover:bg-gray-50
                border border-gray-200 transition cursor-pointer text-[15px]">

                <iconify-icon
                    icon="material-symbols:download"
                    width="20"
                ></iconify-icon>
                Export
            </a>
            
            <a 
                class="inline-flex items-center px-4 py-2 rounded gap-2 bg-white text-black hover:bg-gray-50
                border border-gray-200 transition cursor-pointer text-[15px]">

                <iconify-icon
                    icon="material-symbols:add"
                    width="20"
                ></iconify-icon>
                Add Jobs
            </a>
        </div>
    </div> 
    
    <div class="flex flex-row items-center gap-2">

        <div class="relative">
            <iconify-icon
                icon="material-symbols:search"
                width="20"
                class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"
            ></iconify-icon>
            <input
                type="text"
                name="search"
                placeholder="Cari pelamar..."
                class="w-64 bg-white rounded border border-gray-200 h-10 text-[12px] pl-10 pr-4"
            >
        </div>

        <div class="relative flex items-center">
            <select class="w-42 pl-4 pr-10 h-10 bg-white border border-gray-200 rounded cursor-pointer appearance-none text-[12px] focus:outline-none focus:border-black transition-colors">

                <option value="filter">Filter</option>

            </select>

            <iconify-icon 
                    icon="mdi:chevron-down" 
                    width="20"
                    class="absolute right-3 text-gray-400 pointer-events-none"
                ></iconify-icon>
        </div>
    

        <div class="relative flex items-center">
            <select class="w-42 pl-4 pr-10 h-10 bg-white border border-gray-200 rounded cursor-pointer appearance-none text-[12px] focus:outline-none focus:border-black transition-colors">
                
                <option value="pending">Pending</option>
                <option value="review"> Review</option>
                <option value="interview">Interview</option>
                <option value="accepted">Accepted</option>
                <option value="rejected">Rejected</option>

            </select>

            <iconify-icon 
                icon="mdi:chevron-down" 
                width="15"
                class="absolute right-3 text-gray-400 pointer-events-none"
            ></iconify-icon>

        </div>

        <div class="relative flex items-center">
            <select class="w-42 pl-4 pr-10 h-10 bg-white border border-gray-200 rounded cursor-pointer appearance-none text-[12px] focus:outline-none focus:border-black transition-colors">

                <option value="filter">Filter</option>

            </select>

            <iconify-icon 
                icon="mdi:chevron-down" 
                width="20"
                class="absolute right-3 text-gray-400 pointer-events-none"
            ></iconify-icon>
        </div>

        <div class="relative flex items-center">
            <select class="w-42 pl-4 pr-10 h-10 bg-white border border-gray-200 rounded cursor-pointer appearance-none text-[12px] focus:outline-none focus:border-black transition-colors">

                <option value="filter">Filter</option>

            </select>

            <iconify-icon 
                icon="mdi:chevron-down" 
                width="20"
                class="absolute right-3 text-gray-400 pointer-events-none"
            ></iconify-icon>
        </div>
        
        <div x-data="{ grid: true }" class="flex p-1 gap-1 ml-auto bg-gray-100 border border-gray-200 rounded-md">

            <!-- Tombol Grid -->
            <button
                @click="grid = true"
                :class="grid ? 'bg-white text-black shadow-sm' : 'bg-transparent text-gray-400 hover:text-gray-700'"
                class="p-1.5 rounded flex items-center justify-center transition-all cursor-pointer"
                >
                <iconify-icon
                    icon="mdi:grid"
                    width="20"
                ></iconify-icon>
            </button>

            <!-- Tombol Column/List -->
            <button
                @click="grid = false"
                :class="!grid ? 'bg-white text-black shadow-sm' : 'bg-transparent text-gray-400 hover:text-gray-700'"
                class="p-1.5 rounded flex items-center justify-center transition-all cursor-pointer"
                >
                <iconify-icon
                    icon="fluent:text-column-wide-20-regular"
                    width="20"
                ></iconify-icon>
            </button>

        </div>

    </div>

</div>