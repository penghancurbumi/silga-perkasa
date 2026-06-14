<div class="flex flex-col flex-1 overflow-hidden">
    <div class="flex flex-row items-center justify-between mb-2">
        <div class="flex flex-col">
            <h1 class="font-semibold text-[20px]">Content Management</h1>
            <span class="text-[13px] text-gray-400">Pusat kendali untuk mengelola dan memantau konten blog secara efisien</span>
        </div>

        <div class="flex items-center gap-2">

            <a href="{{ route('content.export', 'csv')}}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-white text-black rounded hover:bg-gray-50 
                border border-gray-200 transition cursor-pointer text-[15px]">
                <iconify-icon
                    icon="material-symbols:download"
                    width="20">
                </iconify-icon>
                    Export
            </a>
            
            <a type="button" href="{{ route('content.create')}}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-white text-black rounded hover:bg-gray-50 
                border border-gray-200 transition cursor-pointer text-[15px]">
                <iconify-icon
                    icon="material-symbols:add"
                    width="20">
                </iconify-icon>
                    Artikel Baru
            </a>
        </div>
    </div>

    {{--Widget--}}
        @php
            $stats = [
                [
                    'label' => 'Total Artikel', 
                    'value' => $totalPosts ?? 0, 
                    'icon' => 'material-symbols:article-outline',
                    'color' => 'bg-gray-50'
                ],
                [
                    'label' => 'Terpublikasi', 
                    'value' => $totalPublished ?? 0, 
                    'icon' => 'ix:success',
                    'color' => 'bg-gray-50'
                ],
                [
                    'label' => 'Draft', 
                    'value' => $totalDraft ?? 0, 
                    'icon' => 'mdi:file-outline',
                    'color' => 'bg-gray-50'
                ],
                [
                    'label' => 'Total View', 
                    'value' => $totalViews ?? 0, 
                    'icon' => 'mdi:eye-outline',
                    'color' => 'bg-gray-50'
                ],
            ];
        @endphp
    <div class="grid grid-cols-4 gap-2 mb-3">        
    @foreach($stats as $stat)
        <div class="bg-white rounded border border-gray-200 px-4 py-3 flex items-center">
            <div class="flex items-center justify-center rounded-lg gap-2">

                <iconify-icon
                    icon="{{ $stat['icon'] }}"
                    width="20"
                    class="text-{{ $stat['color'] }}-600 bg-gray-200 border border-gray-400 p-2 rounded">
                </iconify-icon>

                <div>
                    <p class="text-xs text-black font-semibold">
                        {{ $stat['label']}}
                    </p>

                    <p class="text-xl font-semibold text-black">
                        {{ $stat['value'] }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Filter & search --}}
    <div class="flex flex-row gap-2">
        <div class="relative">
            <iconify-icon 
                icon="material-symbols:search"
                width="20"
                class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
            </iconify-icon>

            <input wire:model.live="search"
                type="text"
                name="search"
                placeholder="Search Article..."
                class="w-64 bg-white border border-gray-200 rounded h-10 pl-10 pr-4 text-[12px]">
        </div>

        <div class="relative filter-wrapper">
            <select wire:model.live="filterKategori"
                class="filter-button flex items-center w-48 px-4 h-10 gap-3 bg-white border border-gray-200 rounded cursor-pointer">

                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name}}</option>
                @endforeach

                <iconify-icon
                    icon="fe:arrow-up"
                    width="20"
                    class="filter-arrow ml-auto transition-transform duration-200"
                ></iconify-icon>
            </select>
        </div>


        <div class="relative filter-wrapper">
            <select  wire:model.live="filterUrutan"
            class="filter-button flex items-center w-48 px-4 h-10 gap-3 bg-white border border-gray-200 rounded cursor-pointer">

                <option value="terbaru">Terbaru</option>
                <option value="terlama">Terlama</option>

                <iconify-icon
                    icon="fe:arrow-up"
                    width="20"
                    class="filter-arrow ml-auto transition-transform duration-300"
                ></iconify-icon>
            </select>
        </div>
    </div>

    <div class="flex border-b border-gray-200 mt-4 gap-5">
        <button wire:click="setTab('semua')"
        class="px-6 py-1.5 text-sm border-b-2 font-semibold cursor-pointer
            {{ $activeTab === 'semua' ? 'border-black text-black' : 'border-transparent text-gray-400'}}">
            Semua
        </button>

        <button wire:click="setTab('terpublikasi')"
        class="px-6 py-1.5 text-sm border-b-2 font-semibold hover:text-gray-700 cursor-pointer 
            {{ $activeTab === 'terpublikasi' ?  'border-black text-black' : 'border-transparent text-gray-400'}} ">
            Terpublikasi
        </button>

        <button wire:click="setTab('draft')"
        class="px-6 py-1.5 text-sm border-b-2 font-semibold hover:text-gray-700 cursor-pointer
            {{ $activeTab === 'draft' ? 'border-black text-black' :'border-transparent text-gray-400'}} ">
            Draft
        </button>

        <button wire:click="setTab('terjadwal')"
        class="px-6 py-1.5 text-sm border-b-2 font-semibold hover:text-gray-700 cursor-pointer 
            {{ $activeTab === 'terjadwal' ? 'border-black text-black' : 'border-transparent text-gray-400'}}">
            Terjadwal
        </button>
    </div>


    <div class="flex-1 min-h-0">   
        <table class="w-full text-sm mt-2">
            <thead>
                <tr class="bg-white border-y border-gray-200">
                    <th class="px-4 py-3 text-left font-medium text-gray-500">
                        <input type="checkbox">
                    </th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Artikel</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Kategori</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Status</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Penulis</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Views</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Tanggal</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($posts as $post)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <input type="checkbox" value="{{ $post->id }}">
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                <iconify-icon icon="material-symbols:article-outline" width="20" class="text-gray-400"></iconify-icon>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 truncate max-w-[200px]">{{ $post->title }}</p>
                                <p class="text-xs text-gray-400 font-mono truncate max-w-[200px]">/{{ $post->slug }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">
                            {{ $post->category->name ?? '—' }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        @if($post->status === 'published')
                            <span class="flex items-center gap-1.5 text-xs font-medium text-emerald-700 bg-emerald-50 px-2 py-1 rounded-full w-fit">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Terpublikasi
                            </span>
                        @elseif($post->status === 'draft')
                            <span class="flex items-center gap-1.5 text-xs font-medium text-gray-600 bg-gray-100 px-2 py-1 rounded-full w-fit">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                Draft
                            </span>
                        @elseif($post->status === 'scheduled')
                            <span class="flex items-center gap-1.5 text-xs font-medium text-blue-700 bg-blue-50 px-2 py-1 rounded-full w-fit">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                Terjadwal
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-600">
                        {{ $post->author->name ?? '—' }}
                    </td>
                    <td class="px-4 py-3 text-gray-600">
                        {{ number_format($post->views_count ?? 0) }}
                    </td>
                    <td class="px-4 py-3 text-gray-500 text-xs">
                        {{ $post->published_at?->format('d M Y') ?? '—' }}
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-1">
                            <button wire:click="edit({{ $post->id }})"
                            class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-100">
                                <iconify-icon icon="material-symbols:edit-outline" width="16"></iconify-icon>
                            </button>

                            <button wire:click="preview{{ $post->id }}" target="_blank"
                            class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-100">
                                <iconify-icon icon="material-symbols:visibility-outline" width="16"></iconify-icon>
                            </button>

                            <form action="{{ route('content.destroy', $post->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-red-400 hover:bg-red-50 hover:border-red-200">
                                    <iconify-icon icon="material-symbols:delete-outline" width="16"></iconify-icon>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-4 py-16 text-center text-gray-400">
                        <div class="flex flex-col items-center gap-2">
                            <iconify-icon icon="material-symbols:article-outline" width="40"></iconify-icon>
                            <p class="text-sm">Belum ada artikel</p>
                            <a href="{{ route('content.create') }}" class="text-xs text-emerald-600 hover:underline">
                                Buat artikel pertama →
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div> 

    {{-- Pagination --}}
    <div class="flex items-center justify-between px-4 py-2 border-t border-gray-100 flex-shrink-0 h-[52px]">
        <p class="text-sm text-gray-500">
            @if($posts->total() > 0)
            Menampilkan {{ $posts->firstItem() }}–{{ $posts->lastItem() }} dari {{ $posts->total() }} artikel
            @else
            tidak ada Artikel
            @endif
        </p>
        {{ $posts->links() }}
    </div>
</div>