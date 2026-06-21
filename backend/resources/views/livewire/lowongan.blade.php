<div x-data="{ grid: true }" class="flex flex-col gap-4">
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
            
            <a type="button" href="{{ route('lowongan.create') }}"
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
                wire:model.live.debounce.300ms="search"
                placeholder="Cari lowongan..."
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
            <select wire:model.live="statusFilter" class="w-42 pl-4 pr-10 h-10 bg-white border border-gray-200 rounded cursor-pointer appearance-none text-[12px] focus:outline-none focus:border-black transition-colors">
                
                <option value="filter">Filter Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
                <option value="closed">Closed</option>

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
        
        <div class="flex p-1 gap-1 ml-auto bg-gray-100 border border-gray-200 rounded-md">

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

   <!-- Layout Grid (Kotak-kotak) -->
    <div x-cloak x-show="grid" class="mt-4 grid grid-cols-3 gap-4">
        @forelse($lowongans as $lowongan)
        <div class="bg-white p-4 rounded border border-gray-200 shadow-sm flex flex-col gap-2 w-full h-[250px]">

            <div class="flex flex-row justify-between gap-2 items-center">
                <div class="flex flex-row gap-2">

                    <div class="flex items-center gap-1">
                        <iconify-icon
                            icon="uil:suitcase-alt"
                            width="15"
                            class="text-gray-500"
                        ></iconify-icon>

                        <p class="text-xs text-gray-500">{{ $lowongan->category }}</p>
                    </div>
                    
                    <div class="flex items-center gap-1">
                        <iconify-icon
                            icon="humbleicons:location"
                            width="15"
                            class="text-gray-500"
                        ></iconify-icon>

                        <p class="text-xs text-gray-500">{{ $lowongan->location }}</p>
                    </div>
                    
                    <div class="flex items-center gap-1">
                        <iconify-icon
                            icon="uil:clock"
                            width="15"
                            class="text-gray-500"
                        ></iconify-icon>

                        <p class="text-xs text-gray-500">{{ $lowongan->employment_type }}</p>
                    </div>
                </div>
                
                <div class="flex flex-row gap-2">
                    <span class="px-2 py-1 text-[10px] rounded {{ $lowongan->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} capitalize">
                        {{ $lowongan->status }}
                    </span>

                    <iconify-icon
                        icon="ri:more-line"
                        width="20"
                        class="cursor-pointer text-gray-400 hover:text-gray-700 transition-colors"
                    ></iconify-icon>
                </div>
                
            </div>

            <div class="flex flex-col flex-grow justify-center">
                <h3 class="text-lg font-semibold">{{ $lowongan->title }}</h3>
                <span class="text-[12px] text-gray-400 mt-2">
                    {{ $lowongan->description }}
                </span>
            </div>

            <div class="mt-auto pt-4 border-t border-gray-200 flex justify-between items-center text-xs text-gray-500">
                <span>Deadline: {{ $lowongan->deadline ? \Carbon\Carbon::parse($lowongan->deadline)->format('d M Y') : '-' }}</span>
                <span class="text-gray-500 cursor-pointer">View Details</span>
            </div>

        </div>
        @empty
        <div class="w-full py-8 text-center text-gray-500 bg-white rounded border border-gray-200">
            Belum ada data lowongan.
        </div>
        @endforelse
    </div>

    <!-- Layout Column (Tabel) -->
    <div x-cloak x-show="!grid" class="bg-white flex flex-col">
        <div class="overflow-x-auto min-h-[400px]">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200 ">
                        <th class="px-4 p-3 text-left font-medium text-gray-500 w-12">
                            <input type="checkbox">
                        </th>
                        <th class="px-4 py-3 text-left font-medium text-gray-500">Title</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-500">Department</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-500">Location</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-500">Type</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-500">Status</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-500">Deadline</th>
                    </tr>
                </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($lowongans as $lowongan)
                <tr class="hover:bg-gray-50"> 
                    <td class="px-4 py-2">
                        <input type="checkbox" value="{{ $lowongan->id }}">
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <p class="text-sm font-medium text-gray-500 truncate">{{ $lowongan->title }}</p>
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <span class="text-xs text-gray-500">{{ $lowongan->category }}</span>
                    </td>
                    <td class="px-4 py-2">
                        <span class="text-xs text-gray-500">{{ $lowongan->location }}</span>
                    </td>
                    <td class="px-4 py-2">
                        <span class="text-xs text-gray-500 capitalize">{{ $lowongan->employment_type }}</span>
                    </td>
                    <td class="px-4 py-2">
                        <span class="text-xs px-2 py-1 rounded {{ $lowongan->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} capitalize">{{ $lowongan->status }}</span>
                    </td>
                    <td class="px-4 py-2">
                        <span class="text-xs text-gray-500">{{ $lowongan->deadline ? \Carbon\Carbon::parse($lowongan->deadline)->format('d M Y') : '-' }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">Belum ada Lowongan.</td>
                </tr>
                @endforelse
            </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $lowongans->links() }}
    </div>

</div>