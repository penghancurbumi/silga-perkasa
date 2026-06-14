<div>
    <h1 class="text-xl font-semibold">PT Silga Perkasa Dashboard</h1>

    {{-- Widget Stats --}}
    <div class="grid grid-cols-4 gap-4 mt-4">

        {{--Widget Pelamar--}}
        <div class="bg-white p-3 rounded border border-gray-200">
            <div class="flex flex-col">
                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-1 border-b border-gray-200 pb-1">
                        <iconify-icon 
                            icon="iconamoon:profile" 
                            width="16"
                            class="bg-[#f0efed] border rounded p-1 border-gray-300">
                        </iconify-icon>
                        <h2 class="text-[12px] font-semibold text-black">Total Pelamar</h2>
                    </div>
                    <span class="text-[25px] font-semibold text-black">0</span>
                </div>
               
                <div class="flex flex-row gap-2 items-center">
                    <span class="text-[11px] font-bold text-green-600">+1</span>
                    <span class="text-[10px] font-semibold text-gray-500">Last Month</span>
                </div>
            </div>
        </div>
        
        {{--Widget Pelamar Diterima--}}
        <div class="bg-white p-3 rounded border border-gray-200">
            <div class="flex flex-col">
                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-1 border-b border-gray-200 pb-1">
                        <iconify-icon
                            icon="healthicons:i-documents-accepted-outline-24px"
                            width="16"
                            class="bg-[#f0efed] border rounded p-1 border-gray-300">
                        </iconify-icon>
                        <h2 class="text-[12px] font-semibold text-black">Pelamar Diterima</h2>
                    </div>
                    <span class="text-[25px] font-semibold text-black">0</span>
                </div>

                <div class="flex flex-row gap-2">
                    <span class="text-[11px] font-bold text-green-600">+0</span>
                    <span class="text-[10px] font-semibold text-gray-500">Last Month</span>
                </div>
            </div>
        </div>
        
        {{--Widget Pelamar Ditolak--}}
        <div class="bg-white p-3 rounded border border-gray-200">
            <div class="flex flex-col">
                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-1 border-b border-gray-200 pb-1">
                        <iconify-icon
                            icon="icon-park-outline:reject"
                            width="16"
                            class="bg-[#f0efed] border border-gray-300 rounded p-1">
                        </iconify-icon>
                        <h2 class="text-[12px] font-semibold text-black">Pelamar Ditolak</h2>
                    </div>
                    <span class="text-[25px] font-semibold text-black">0</span>
                </div>

                <div class="flex flex-row gap-2">
                    <span class="text-[11px] font-bold text-green-600">+0</span>
                    <span class="text-[10px] font-semibold text-gray-500">Last Month</span>
                </div>
            </div>
        </div>

        {{--Widget Lowongan Aktif--}}
        <div class="bg-white p-3 rounded border border-gray-200">
            <div class="flex flex-col">
                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center gap-1 border-b border-gray-200 pb-1">
                        <iconify-icon
                            icon="subway:tick"
                            width="16"
                            class="bg-[#f0efed] border border-gray-300 rounded p-1">
                        </iconify-icon>
                        <h2 class="text-[12px] font-semibold text-black">Lowongan Aktif</h2>
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

    {{-- Chart + Kalender --}}
    <div class="grid grid-cols-4 gap-4 mt-4">      
        <div class="bg-white col-span-3 p-4 rounded border border-gray-200">
            <div class="flex items-center justify-between mb-3">
                <p class="text-[13px] font-semibold text-gray-700">Aktivitas</p>
                {{-- Filter Periode --}}
                <div class="flex items-center gap-1">
                    @foreach(['day' => 'Hari', 'week' => 'Minggu', 'month' => 'Bulan', 'year' => 'Tahun'] as $key => $label)
                        <button
                            wire:click="setPeriod('{{ $key }}')"
                            class="px-3 py-1 text-[11px] font-semibold rounded transition
                                {{ $period === $key
                                    ? 'bg-gray-800 text-white'
                                    : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            </div>
            <div class="h-48">
                <canvas id="salesChart"
                    wire:ignore
                    data-labels="{{ json_encode($chartLabels) }}"
                    data-values="{{ json_encode($chartValues) }}">
                </canvas>
            </div>
        </div>

        <div class="bg-white col-span-1 p-4 rounded border border-gray-200">
            <div wire:ignore id="calendar" class="flex-1"></div>
        </div>
    </div>

    {{-- Aktivitas Terbaru --}}
    <div class="bg-white border border-gray-200 mt-4 rounded">
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
            <p class="text-[13px] font-semibold text-gray-700">Aktivitas Terbaru</p>
            <a href="{{ route('content') }}" wire:navigate class="text-[11px] text-blue-500 hover:underline">Lihat semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-[12px]">
                <thead>
                    <tr class="text-left text-gray-500 bg-gray-50">
                        <th class="px-4 py-2 font-semibold">Deskripsi</th>
                        <th class="px-4 py-2 font-semibold">Pengguna</th>
                        <th class="px-4 py-2 font-semibold">Tipe</th>
                        <th class="px-4 py-2 font-semibold">IP Address</th>
                        <th class="px-4 py-2 font-semibold">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($recentActivity as $log)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-2 text-gray-700">
                                {{ $log->description }}
                            </td>
                            <td class="px-4 py-2 text-gray-500">
                                {{ $log->user?->email ?? '—' }}
                            </td>
                            <td class="px-4 py-2">
                                @php
                                    $typeMap = [
                                        'login'       => ['label' => 'Login',       'class' => 'bg-green-100 text-green-700'],
                                        'logout'      => ['label' => 'Logout',      'class' => 'bg-red-100 text-red-600'],
                                        'create_post' => ['label' => 'Buat Artikel', 'class' => 'bg-blue-100 text-blue-700'],
                                        'edit_post'   => ['label' => 'Edit Artikel', 'class' => 'bg-yellow-100 text-yellow-700'],
                                    ];
                                    $t = $typeMap[$log->type] ?? ['label' => ucfirst($log->type), 'class' => 'bg-gray-100 text-gray-600'];
                                @endphp
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $t['class'] }}">
                                    {{ $t['label'] }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-gray-400">
                                {{ $log->ip_address }}
                            </td>
                            <td class="px-4 py-2 text-gray-400 whitespace-nowrap">
                                {{ $log->created_at->diffForHumans() }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-400">
                                Belum ada aktivitas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>