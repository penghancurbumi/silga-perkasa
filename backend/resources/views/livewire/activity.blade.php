<div class="flex flex-col">
    <div class="flex items-center justify-between flex-shrink-0">
        <div>
            <h1 class="text-2xl font-semibold">Activity Log</h1>
            <p class="text-xs text-gray-400 mt-1">View a complete history of your recent activities and interactions.</p>
        </div>

        {{-- Filter Controls --}}
        <div class="flex items-center gap-4">
            
            {{-- Dropdown Filter Tipe Aktivitas --}}
            <div class="relative flex items-center">
                <iconify-icon icon="mdi:filter-variant" width="14" class="absolute left-2.5 text-gray-400"></iconify-icon>
                <select wire:model.live="typeFilter" class="pl-7 pr-8 py-1.5 text-[11px] font-semibold text-gray-600 bg-white border border-gray-200 rounded hover:bg-gray-50 focus:outline-none focus:border-gray-400 cursor-pointer appearance-none transition-colors">
                    <option value="all">Semua Tipe</option>
                    <option value="login">Login</option>
                    <option value="logout">Logout</option>
                    <option value="create_post">Buat Artikel</option>
                    <option value="edit_post">Edit Artikel</option>
                </select>
                <iconify-icon icon="mdi:chevron-down" width="14" class="absolute right-2.5 text-gray-400 pointer-events-none"></iconify-icon>
            </div>

            {{-- Tombol Filter Periode --}}
            <div class="flex items-center gap-1">
                @foreach(['day' => 'Hari Ini', 'week' => 'Minggu', 'month' => 'Bulan'] as $key => $label)
                    <button
                        wire:click="setPeriod('{{ $key }}')"
                        class="px-3 py-1.5 text-[11px] font-semibold rounded transition
                            {{ $period === $key
                                ? 'bg-gray-800 text-white shadow-sm'
                                : 'bg-gray-50 text-gray-500 hover:bg-gray-200 border border-transparent' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 mt-4 rounded-lg flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-[12px]">
                <thead>
                    <tr class="text-left text-gray-500 bg-gray-50 border-b border-gray-100">
                        <th class="px-4 py-2.5 font-semibold">Deskripsi</th>
                        <th class="px-4 py-2.5 font-semibold w-64">Pengguna</th>
                        <th class="px-4 py-2.5 font-semibold w-32">Tipe</th>
                        <th class="px-4 py-2.5 font-semibold w-36">IP Address</th>
                        <th class="px-4 py-2.5 font-semibold w-36">Waktu</th>
                    </tr>
                </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($recentActivity as $log)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-2 text-gray-700">
                                    {{ $log->description }}
                                </td>
                                <td class="px-4 py-2 text-gray-500">
                                    {{ $log->user?->name ?: ($log->user?->email ?? '—') }}
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
        
        @if($recentActivity->hasPages())
            <div class="p-4 border-t border-gray-100 flex justify-end flex-shrink-0 bg-white rounded-b-lg">
                {{ $recentActivity->links() }}
            </div>
        @endif
    </div>
</div>
