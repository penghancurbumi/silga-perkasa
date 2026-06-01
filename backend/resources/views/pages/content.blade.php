<div>
    <div class="flex items-center justify-between">
        <div class="flex flex-col">
            <h1 class="text-2xl font-semibold">Management Content</h1>
            <span class="text-[12px] text-gray-500">Kelola semua artikel blog anda di satu tempat</span>
        </div>
    
        <div class="flex items-center gap-2">
            <button class="flex items-center bg-white px-3 py-2 border border-gray-300 rounded text-[12px] cursor-pointer gap-2">
                <iconify-icon icon="material-symbols:download" width="15"></iconify-icon>
                <span class="text-[12px] font-semibold">Export</span>
            </button>

            <button class="flex items-center bg-white px-3 py-2 border border-gray-300 rounded text-[12px] cursor-pointer gap-2">
                <iconify-icon icon="ic:baseline-plus" width="15"></iconify-icon>
                <span class="text-[12px] font-semibold">Add Artikel</span>
            </button>
        </div>
    </div>

    {{--Widget content--}}
    <div class="grid grid-cols-4 gap-4 mt-4">

        <div class="bg-white p-3 rounded shadow">
            <div class="flex flex-row items-center gap-2">
                <div class="bg-[#f0efed] border rounded p-2 border-gray-300 flex items-center justify-center">
                    <iconify-icon 
                        icon="material-symbols:article-outline" 
                        width="20">
                    </iconify-icon> 
               </div> 

                <div class="flex flex-col">
                    <span class="text-[20px] font-semibold">20</span>
                    <span class="text-[10px] text-gray-500">Total Artikel</span>
                </div> 
            </div>
        </div>

        <div class="bg-white p-3 rounded shadow">
            <div class="flex flex-row items-center gap-2">
                <div class="bg-[#f0efed] border border-gray-300 rounded p-2 flex items-center justify-center">
                    <iconify-icon 
                        icon="tabler:circle-check" 
                        width="20">
                    </iconify-icon>
                </div>
                <div class="flex flex-col">
                    <span class="text-[20px] font-semibold">5</span>
                    <span class="text-[10px] text-gray-500">Terpublikasi</span>
                </div>
            </div>
        </div>

         <div class="bg-white p-3 rounded shadow">
            <div class="flex flex-row items-center gap-2">
                <div class="bg-[#f0efed] border border-gray-300 rounded p-2 flex items-center justify-center">
                    <iconify-icon
                        icon="material-symbols:draft-outline"
                        width="20">
                    </iconify-icon>
                </div>
                <div class="flex flex-col">
                    <span class="text-[20px] font-semibold">8</span>
                    <span class="text-[10px] text-gray-500">Draft</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-3 rounded shadow">
            <div class="flex flex-row items-center gap-2">
                <div class="bg-[#f0efed] border border-gray-300 rounded p-2 flex items-center justify-center">
                    <iconify-icon
                        icon="mdi:eye"
                        width="20">
                    </iconify-icon>
                </div>
                 <div class="flex flex-col">
                    <span class="text-[20px] font-semibold">10.5k</span>
                    <span class="text-[10px] text-gray-500">Total views</span>
                </div>
            </div>  
        </div>
    </div>

    <div class="flex flex-row items-center gap-4 mt-4">
        <input 
            type="text"
            placeholder="Search..."
            class="px-5 py-2 bg-white border border-gray-300 rounded text-[12px]"
            >
        <div>
            <button type="button"
                class="bg-white border border-gray-300 flex items-center justify-between w-full gap-3 px-4 py-2 rounded ">
                <div class="flex items-center">
                    <span class="text-[12px]">Semua Kategori</span>
                </div>
                <iconify-icon icon="fe:arrow-up" width="18" height="18"></iconify-icon>
            </button>
        </div>

        <div>
            <button type="button"
                class="bg-white border border-gray-300 flex items-center justify-between w-full gap-3 px-4 py-2 rounded">
                <div class="flex items-center">
                    <span class="text-[12px]">Terbaru</span>
                </div>
                <iconify-icon icon="fe:arrow-up" width="18" height="18"></iconify-icon>
            </button>
        </div>
            
        <div>
            <button type="button"
                class="bg-white border border-gray-300 flex items-center justify-between w-full gap-3 px-4 py-2 rounded">
                <div class="flex items-center gap-2">
                    <iconify-icon icon="material-symbols:sort" width="18" height="18"></iconify-icon>
                    <span class="text-[12px]">Sort</span>
                </div>
            </button>
        </div>
    </div>

    {{--menu section--}}
    <div class="flex border-b border-gray-300 mt-4">
        <button wire:click="$set('activeTab','semua')"
            class="px-4 py-2 text-sm font-medium border-b-2 hover:text-gray-700 cursor-pointer
            {{$activeTab === 'semua' ? 'border-black text-black' : 'border-transparent text-gray-500'}}">
            Semua(20)
        </button>

        <button wire:click="$set('activeTab','terpublikasi')"
            class="px-4 py-2 text-sm font-medium border-b-2 hover:text-gray-700 cursor-pointer
            {{$activeTab === 'terpublikasi' ? 'border-black text-black' :'border-transparent text-gray-500'}}">
            Terpublikasi(5)
        </button>
        <button wire:click="$set('activeTab','draft')"
            class="px-4 py-2 text-sm font-medium border-b-2 hover:text-gray-700 cursor-pointer
            {{$activeTab === 'draft' ? 'border-black text-black' : 'border-transparent text-gray-500'}}">
            Draft(5)
        </button>
        <button wire:click="$set('activeTab','terjadwal')"
            class="px-4 py-2 text-sm font-medium border-b-2 hover:text-gray-700 cursor-pointer
            {{$activeTab === 'terjadwal' ? 'border-black text-black' : 'border-transparent text-gray-500'}}">
            Terjadwal(5)
        </button>
    </div>

    {{--table--}}
    <table class="w-full text-sm mt-4">
        <thead>
            <tr class="bg-gray-50 border-y border-gray-300">
                <th class="px-4 py-3 text-left font-medium text-gray-300">
                    <input type="checkbox">
                </th>
                <th class="px-4 py-3 text-left font-medium text-black">Artikel</th>
                <th class="px-4 py-3 text-left font-medium text-black">Kategori</th>
                <th class="px-4 py-3 text-left font-medium text-black">status</th>
                <th class="px-4 py-3 text-left font-medium text-black">penulis</th>
                <th class="px-4 py-3 text-left font-medium text-black">view</th>
                <th class="px-4 py-3 text-left font-medium text-black">tanggal</th>
                <th class="px-4 py-3 text-left font-medium text-black">aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
              <tr class="hover:bg-gray-50">
                <td class=""px-4 py-3>
                    <input type="checkbox">
                </td>
              </tr>
        </tbody>
    </table>
</div>