<table class="w-full text-sm mt-4">
    <thead>
        <tr class="bg-gray-50 border-y border-gray-200">
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
                    @if($post->thumbnail)
                        <img src="{{ Storage::url($post->thumbnail) }}"
                             class="w-10 h-10 rounded-lg object-cover border border-gray-100">
                    @else
                        <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                            <iconify-icon icon="material-symbols:article-outline" width="20" class="text-gray-400"></iconify-icon>
                        </div>
                    @endif
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
                    <a href="{{ route('content.edit', $post->id) }}"
                       class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-100">
                        <iconify-icon icon="material-symbols:edit-outline" width="16"></iconify-icon>
                    </a>
                    <a href="{{ route('content.preview', $post->id) }}" target="_blank"
                       class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-100">
                        <iconify-icon icon="material-symbols:visibility-outline" width="16"></iconify-icon>
                    </a>
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

{{-- Pagination --}}
@if($posts->hasPages())
<div class="flex items-center justify-between px-4 py-3 border-t border-gray-100 mt-2">
    <p class="text-xs text-gray-500">
        Menampilkan {{ $posts->firstItem() }}–{{ $posts->lastItem() }} dari {{ $posts->total() }} artikel
    </p>
    {{ $posts->links() }}
</div>
@endif