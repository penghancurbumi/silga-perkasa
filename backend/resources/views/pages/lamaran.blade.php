<div class="flex flex-col gap-4">
    <div class="flex flex-row items-center justify-between mb-2">
        <div class="flex flex-col">
            <h1 class="text-2xl font-semibold">Kelola Lamaran</h1>
            <p class="text-xs text-gray-400 mt-1">
                Kelola seluruh lamaran dan pantau proses seleksi secara efisien dalam satu halaman.
            </p>
        </div>

        <div class="flex items-center gap-2">

            <a 
            class="inline-flex items-center gap-2 px-4 py-2 bg-white text-black rounded hover:bg-gray-50
                border border-gray-200 transition cursor-pointer text-[15px]">

                 <iconify-icon
                    icon="material-symbols:download"
                    width="15"
                ></iconify-icon>
                Export

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
                placeholder="Cari pelamar..."
                class="w-64 bg-white rounded border border-gray-200 h-10 text-[12px] pl-10 pr-4"
            >
        </div>

        <div class="relative flex items-center">
            <select class="w-32 pl-4 pr-10 h-10 bg-white border border-gray-200 rounded cursor-pointer appearance-none text-[12px] focus:outline-none focus:border-black transition-colors">

                <option value="filter">Filter</option>

            </select>

             <iconify-icon 
                    icon="mdi:chevron-down" 
                    width="20"
                    class="absolute right-3 text-gray-400 pointer-events-none"
                ></iconify-icon>
        </div>
        

        <div class="relative flex items-center">
            <select wire:model.live="statusFilter" class="w-32 pl-4 pr-10 h-10 bg-white border border-gray-200 rounded cursor-pointer appearance-none text-[12px] focus:outline-none focus:border-black transition-colors">
                
                <option value="filter">Filter</option>
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

        <div class="flex items-end gap-3">
            <div class="flex flex-row items-center gap-2">
                <span class="text-sm font-semibold">From:</span>
                <input type="datetime-local"
                    class="w-32 bg-white border border-gray-200 px-3 h-10 rounded text-gray-500 cursor-pointer text-[12px]">
            </div>

            <div class="flex flex-row items-center gap-2">
                <span class="text-sm font-semibold">To:</span>
                <input type="datetime-local"
                    class="w-32 bg-white border border-gray-200 px-3 h-10 rounded text-gray-500 cursor-pointer text-[12px]">
            </div>
        </div>

        <div class="flex flex-row items-center gap-2 p-2 cursor-pointer">
            <iconify-icon
                icon="material-symbols:refresh"
                width="20"
                class="text-gray-500"
            ></iconify-icon>

            <span class="text-[15px] text-gray-500 font-semibold">Reset</span>
        </div>

    </div>

    <div class="bg-white flex flex-col">
        <div class="overflow-x-auto min-h-[400px]">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="px-4 p-3 text-left font-medium text-gray-500 w-12">
                            <input type="checkbox">
                        </th>
                        <th class="px-4 py-3 text-left font-medium text-gray-500">Name</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-500">Email</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-500">Position</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-500">Resume</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-500">Status</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-500">Applied At</th>
                    </tr>
                </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($lamarans as $lamaran)
                <tr class="hover:bg-gray-50"> 

                    <td class="px-4 py-2">
                        <input type="checkbox" value="{{ $lamaran->id }}">
                    </td>

                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <p class="text-sm font-reguler text-black truncate">{{ $lamaran->applicant->fullname ?? 'Unknown' }}</p>
                        </div>
                    </td>

                    <td class="px-4 py-2">
                        <span class="text-sm font-reguler text-black">{{ $lamaran->applicant->email ?? '-' }}</span>
                    </td>

                    <td class="px-4 py-2">
                        <span class="text-sm font-reguler text-black">{{ $lamaran->lowongan->title ?? 'Posisi Dihapus' }}</span>
                    </td>

                    <td class="px-4 py-2">
                        <span class="text-sm font-reguler text-black">{{ $lamaran->applicant->resume ?? '-' }}</span>
                    </td>

                    <td class="px-4 py-2">
                        <span class="text-sm font-reguler text-black capitalize">{{ $lamaran->status }}</span>
                    </td>

                    
                    <td class="px-4 py-2">
                        <span class="text-sm font-reguler text-black">{{ \Carbon\Carbon::parse($lamaran->applied_at)->format('M d, Y • h:i A') }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">Belum ada data lamaran.</td>
                </tr>
                @endforelse
            </tbody>
            </table>
        </div>
    </div>
</div>