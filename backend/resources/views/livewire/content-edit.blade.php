@use('Illuminate\Support\Facades\Storage')
 
<div x-data="{
        alertVisible: false,
        alertType: '',
        alertTitle: '',
        alertMessage: '',
        showAlert(type, title, message) {
            this.alertType = type;
            this.alertTitle = title;
            this.alertMessage = message;
            this.alertVisible = true;
            setTimeout(() => this.alertVisible = false, 4000);
        }
    }"
    @edit-success.window="showAlert('success', 'Berhasil!', 'Artikel berhasil diperbarui.'); setTimeout(() => window.location.href = '/content', 1500);"
    @edit-error.window="showAlert('error', 'Error!', 'Gagal menyimpan perubahan artikel.');"
>

    {{-- Alert Notification --}}
    <div x-show="alertVisible" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-x-8"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-x-0"
         x-transition:leave-end="opacity-0 translate-x-8"
         class="fixed top-5 right-5 z-[9999] bg-white p-4 rounded-lg border border-gray-200 shadow-lg min-w-[320px]">
        <div class="flex flex-row space-x-3">
            <template x-if="alertType === 'success'">
                <iconify-icon icon="mdi:tick" width="15" class="text-green-500 border border-gray-200 p-2 rounded-lg bg-green-100"></iconify-icon>
            </template>
            <template x-if="alertType === 'error'">
                <iconify-icon icon="gridicons:cross" width="15" class="text-red-500 border border-gray-200 p-2 rounded-lg bg-red-100"></iconify-icon>
            </template>
            <div class="flex flex-col flex-1">
                <p class="text-[12px] font-semibold" x-text="alertTitle"></p>
                <p class="text-[10px] font-semibold text-gray-400" x-text="alertMessage"></p>
            </div>
            <button @click="alertVisible = false" class="self-start -mt-1 cursor-pointer text-gray-500 hover:text-gray-400">
                <iconify-icon icon="gridicons:cross" width="15"></iconify-icon>
            </button>
        </div>
    </div>
{{--Input New Aritcle--}}
    <div class="flex items-center mb-4">
            <h2 class="text-[20px] font-semibold">Create New Article</h2>
    </div>

    <div class="flex flex-row gap-4">

        <div class="flex flex-col gap-3 w-1/2">
            <div class="flex flex-col gap-2">
                <span class="text-sm font-semibold">Judul</span>
                <input 
                    type="text"
                    wire:model.lazy="title"
                    placeholder="Masukan judul konten..."
                    class="bg-white border px-3 h-10 rounded text-[12px]
                    {{ $errors->has('title') ? 'border-red-500' : 'border-gray-200' }}">
                
                @error('title')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <span class="text-sm font-semibold">Slug</span>
                <div class="flex items-center bg-white border rounded overflow-hidden
                {{ $errors->has('slug') ? 'border-red-500' : 'border-gray-200'}}">
                    <span class="flex items-center px-3 h-full bg-gray-100 text-gray-500 text-[12px]">https://domain.com/</span>

                    <input 
                        type="text"
                        wire:model="slug"
                        class="flex-1 px-3 h-10 text-gray-400 text-[12px]"
                        placeholder="slug-artikel"/>
                </div>
                
                @error('slug')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <span class="text-sm font-semibold">konten</span>
                <textarea 
                    type="text"
                    wire:model.lazy="content"
                    placeholder="Masukan isi dari konten..."
                    class="bg-white border w-full h-[200px] rounded resize-none text-[12px] p-2
                    {{ $errors->has('content') ? 'border-red-500' : 'border-gray-200' }}"
                ></textarea>

                @error('content')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-row gap-2">
                <div class="flex flex-col gap-2 flex-1">
                    <span class="text-sm font-semibold">Kategori</span>
                    <div class="relative w-full">
                        <select wire:model.lazy="category_id"
                            class="w-full bg-white border pl-3 pr-10 h-10 text-[12px] rounded cursor-pointer appearance-none outline-none focus:border-black focus:ring-1 focus:ring-black transition-colors
                            {{ $errors->has('category_id') ? 'border-red-500' : 'border-gray-200' }}">
                            
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <iconify-icon
                            icon="mdi:chevron-down"
                            width="16"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"
                        ></iconify-icon>
                    </div>

                    @error('category_id')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror 
                </div>

                <div class="flex flex-col gap-2 mb-2 flex-1">
                    <span class="text-sm font-semibold">Tanggal Publikasi</span>
                    <input type="datetime-local"
                            wire:model.live="published_at"
                            class="bg-white border px-3 h-10 rounded text-sm text-gray-500 cursor-pointer text-[12px]
                             {{ $errors->has('published_at') ? 'border-red-500' : 'border-gray-200' }}"/>

                    @error('published_at')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror 
                </div>
            </div>


            <div class="flex flex-col gap-2">
                <span class="text-sm font-semibold">thumbnail</span>
                <div class="flex items-center justify-center w-full">

                    <label id="thumbnailInput"
                        class="flex flex-col items-center justify-center w-full h-56 bg-white border border-dashed border-gray-200
                        rounded cursor-pointer hover:bg-gray-50 
                        {{ $errors->has('thumbnail') ? 'border-red-500' : 'border-gray-200' }}">
                        
                        @if($thumbnail && !is_null($thumbnail))
                        <img src="{{ $thumbnail->temporaryUrl() }}"
                            class="w-full h-full object-cover rounded">

                        @elseif($existingThumbnail)
                        <img src="{{ Storage::url($existingThumbnail) }}"
                            class="w-full h-full object-cover rounded">

                        @else
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <iconify-icon icon="humbleicons:upload" width="40" class="text-gray-300"></iconify-icon>
                            <p class="mb-2 text-[12px] text-gray-300"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-[10px] text-gray-300">SVG, PNG, JPG or GIF (MAX. 5MB)</p>
                        </div>

                        @endif
                        <input type="file" id="thumbnailInput" wire:model="thumbnail" accept="image/*" class="hidden">
                    </label>
                </div>

                @error('thumbnail')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2">

                <button wire:click="save('published')" 
                class="inline-flex items-center gap-2 justify-center w-full h-10 bg-white border border-gray-200 
                    py-3 text-sm rounded font-semibold hover:bg-gray-50 cursor-pointer">
                    <iconify-icon icon="tabler:send" width="15"></iconify-icon>
                    Publikasi
                </button>

                <div class="flex flex-row items-center gap-2">

                    <button wire:click="save('scheduled')" 
                    class="inline-flex items-center gap-2 justify-center w-full h-10 bg-white border border-gray-200 
                        py-3 text-sm rounded font-semibold hover:bg-gray-50 cursor-pointer">
                        <iconify-icon icon="mdi:clock-outline" width="15"></iconify-icon>
                        Jadwalkan   
                    </button>

                    <button wire:click="save('draft')" 
                    class="inline-flex items-center gap-2 justify-center w-full h-10 bg-white border border-gray-200 
                        py-3 text-sm rounded font-semibold hover:bg-gray-50 cursor-pointer">
                        <iconify-icon icon="ri:draft-line" width="15"></iconify-icon>
                        Simpan Draft
                    </button>
                </div>
            </div>
        </div>

        {{--Preview Aritcle--}}
        <div class="w-1/2 bg-gray-50 border border-gray-200 p-4 rounded flex flex-col">
            <h3 class="text-medium font-semibold mb-3">Preview</h3>

            <div class="flex-1 bg-white border border-gray-200 rounded overflow-y-auto w-full max-h-[780px]">
                <nav class="bg-white border-b border-gray-200 rounded">
                    <div class="flex items-center justify-between px-3 h-12">
                        <img 
                            src="/images/logo-icon.png" 
                            alt="silga perkasa logo"
                            width="100"
                            height="15"
                        />
                        
                        <ul class="flex items-center gap-2">
                            <li><a href="#" class="text-[10px] font-medium text-black">Home</a></li>
                            <li><a href="#" class="text-[10px] font-medium text-black">About Us</a></li>
                            <li><a href="#" class="text-[10px] font-medium text-black">Career</a></li>
                            <li><a href="#" class="text-[10px] font-medium text-black">Blog</a></li>
                            <li><a href="#" class="text-[10px] font-medium text-black">Contact</a></li>
                        </ul>
                    </div>
                </nav>

                <div class="flex flex-col gap-2 px-4 py-3">
                     <div class="w-full h-48 bg-gray-200 flex items-center justify-center">

                        @if($thumbnail && !is_null($thumbnail))
                         <img src="{{ $thumbnail->temporaryUrl() }}"
                            class="w-full h-full object-cover rounded">
                        
                        @elseif($existingThumbnail)
                         <img src="{{ Storage::url($existingThumbnail) }}"
                            class="w-full h-full object-cover rounded">

                        @else
                        <span class="text-[15px] font-semibold text-gray-500">Thumbnail</span>
                        @endif
                    </div>

                    <div class="flex flex-col gap-3">
                        <h1 class="text-[15px] font-semibold {{ $title ? 'text-black' : 'text-gray-300'}}">
                            {{ $title ?: 'Masukan Judul artikel'}}
                        </h1>

                        <span class="text-[10px] font-medium text-gray-500">
                            Penulis: {{ auth()->user()?->name ?? 'Unknown'}}
                            | {{ $published_at ? \Carbon\Carbon::parse($published_at)->translatedFormat('d F Y, H:i') : '-'}}
                        </span>

                        <span class="text-[10px] font-medium text-gray-500">
                            {{ $category_id ? $categories->find($category_id)?->name : '-'}}
                        </span>

                        <p class="text-[10px] leading-relaxed whitespace-pre-line {{ $content ?  'text-black' : 'text-gray-300'}}">{{ trim($content) ?: 'Masukan isi konten'}}</p>
                    </div>
                </div>
               
            </div>
        </div>

    </div>
</div>
