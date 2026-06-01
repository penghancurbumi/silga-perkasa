<div>
   <h1 class="text-xl font-semibold">PT Silga Perkasa Dashboard</h1>

    <div class="grid grid-cols-4 gap-4 mt-4">

        {{--Widget Pelamar--}}
        <div class="bg-white p-3 rounded shadow">
            <div class="flex flex-col">
                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-1 border-b border-gray-200 pb-1">
                        <iconify-icon 
                            icon="iconamoon:profile" 
                            width="16"
                            class="bg-[#f0efed] border rounded p-1 border-gray-300">
                        </iconify-icon>
                        <h1 class="text-[12px] font-semibold text-black">Total Pelamar</h1>
                    </div>
                    <span class="text-[25px] font-semibold text-black">0</span>
                </div>
               
                <div class="flex flex-row gap-2 items-center">
                    <span class="text-[11px] font-bold text-green-600">+1</span>
                    <span class="text-[10px] font-semibold text-gray-500">Last Month</span>
                </div>
            </div>
        </div>
        
        {{--Widget Pelamar diterima--}}
        <div class="bg-white p-3 rounded shadow ">
            <div class="flex flex-col">
                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-1 border-b border-gray-200 pb-1">
                        <iconify-icon
                            icon="healthicons:i-documents-accepted-outline-24px"
                            width="16"
                            class="bg-[#f0efed] border rounded p-1 border-gray-300">
                        </iconify-icon>
                        <h1 class="text-[12px] font-semibold text-black">Pelamar Diterima</h1>
                    </div>
                    <span class="text-[25px] font-semibold text-black">0</span>
                </div>

                <div class="flex flex-row gap-2">
                    <span class="text-[11px] font-bold text-green-600">
                    +0</span>
                    <span class="text-[10px] font-semibold text-gray-500">Last Month</span>
                </div>
            </div>
        </div>
        
        {{--Widget Pelamar ditolak--}}
        <div class="bg-white p-3 rounded shadow ">
            <div class="flex flex-col">
                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-1 border-b border-gray-200 pb-1">
                        <iconify-icon
                            icon="icon-park-outline:reject"
                            width="16"
                            class="bg-[#f0efed] border border-gray-300 rounded p-1">
                        </iconify-icon>
                        <h1 class="text-[12px] font-semibold text-black">Pelamar Ditolak</h1>
                    </div>
                    <span class="text-[25px] font-semibold text-black">0</span>
                </div>

                <div class="flex flex-row gap-2">
                    <span class="text-[11px] font-bold text-green-600">+0</span>
                    <span class="text-[10px] font-semibold text-gray-500">Last Month</span>
                </div>
            </div>
        </div>

        {{--Widget Lowongan aktif--}}
        <div class="bg-white p-3 rounded shadow ">
            <div class="flex flex-col">
                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-1 border-b border-gray-200 pb-1">
                        <iconify-icon
                            icon="subway:tick"
                            width="16"
                            class="bg-[#f0efed] border border-gray-300 rounded p-1">
                        </iconify-icon>
                        <h1 class="text-[12px] font-semibold text-black">Lowongan Aktif</h1>
                    </div>
                    <span class="text-[25px] font-semibold text-black">0</span>
                </div>
                <div class="flex flex-row items-center gap-2">
                    <span class="text-[11px] font-bold text-green-600">+0</span>
                    <span class="text-[10px] font-semibold text-gray-500">Last Month</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-4 gap-4 mt-4">      
        <div class="bg-white col-span-3 p-4 rounded shadow">
            Chart
        </div>
        <div class="bg-white col-span-1 p-4 rounded shadow">
            <div id="calendar" class="flex-1"></div>
        </div>
    </div>

    <div class="bg-white h-[300px] shadow mt-4 flex-1 min-h-0">
        activity
    </div>
</div>