<div >
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
                    wire:model.live="title"
                    class="bg-white border border-gray-200 px-3 h-10 rounded text-[12px]">
            </div>

            <div class="flex flex-col gap-2">
                <span class="text-sm font-semibold">Slug</span>
                <div class="flex items-center bg-white border border-gray-200 rounded overflow-hidden">
                    <span class="flex items-center px-3 h-full bg-gray-100 text-gray-500 text-[12px]">https://domain.com/</span>

                <input 
                    type="text"
                    wire:model="slug"
                    class="flex-1 px-3 h-10 text-gray-400 text-[12px]"
                    placeholder="slug-artikel">
                </div>
            </div>

            <div class="flex flex-col">
                <span class="text-sm font-semibold">konten</span>
                <textarea 
                    type="text"
                    wire:model.live="content"
                    class="bg-white border border-gray-200 w-full h-[200px] rounded resize-none text-[12px]"
                ></textarea>
            </div>

            <div class="flex flex-row gap-2">
                <div class="flex flex-col gap-2 flex-1">
                    <span class="text-sm font-semibold">Kategori</span>
                        <select wire:model="category_id"
                            class="bg-white border border-gray-200 px-3 h-10 text-[12px] rounded cursor-pointer">
                            
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach

                            <iconify-icon
                                icon="fe:arrow-up"
                                width="20"
                                class="dropdown-arrow ml-auto transition-transform duration-300"
                            ></iconify-icon>
                        </select>
                </div>

                <div class="flex flex-col gap-2 mb-2 flex-1">
                        <span class="text-sm font-semibold">Tanggal Publikasi</span>
                        <input type="datetime-local"
                                class="bg-white border border-gray-200 px-3 h-10 rounded text-sm text-gray-500 cursor-pointer text-[12px]">
                    </div>
            </div>


            <div class="flex flex-col gap-2">
                <span class="text-sm font-semibold">thumbnail</span>
                <div class="flex items-center justify-center w-full">

                <input type="file" id="thumbnailInput" accept="image/*" class="hidden">

                    <div onclick="document.getElementById('thumbnailInput').click()"
                    id="uploadArea"
                    class="flex flex-col items-center justify-center w-full h-56 bg-white border border-dashed border-gray-200
                    rounded cursor-pointer hover:bg-gray-50 ">

                    <img id="thumbnailPreview" src="" alt="preview" class="hidden w-full h-full object-cover rounded">

                        <div id="uploadPlaceholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                            <iconify-icon icon="humbleicons:upload" width="40" class="text-gray-300"></iconify-icon>
                            <p class="mb-2 text-[12px] text-gray-300"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-[10px] text-gray-300">SVG, PNG, JPG or GIF (MAX. 5MB)</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-2">

                <button wire:click="save('publish')" 
                class="inline-flex items-center gap-2 justify-center w-full h-10 bg-white border border-gray-200 
                    py-3 text-sm rounded font-semibold hover:bg-gray-50 cursor-pointer">
                    <iconify-icon icon="tabler:send" width="15"></iconify-icon>
                    Publikasi
                </button>

                <div class="flex flex-row items-center gap-2">

                    <button wire:click="save('schedule')" 
                    class="inline-flex items-center gap-2 justify-center w-full h-10 bg-white border border-gray-200 
                        py-3 text-sm rounded font-semibold hover:bg-gray-50 cursor-pointer">
                        <iconify-icon icon="mdi:clock-outline" width="15"></iconify-icon>
                        Jadwalkan   
                    </button>

                    <button wire:click="save('saveDraft')" 
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

            <div class="flex-1 bg-white border border-gray-200 rounded">
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
                        <span class="text-[15px] font-semibold text-gray-500">Thumbnail</span>
                    </div>

                    <div class="flex flex-col gap-3">
                        <h1 class="text-[15px] font-semibold">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        </h1>
                        
                        <span class="text-[10px] font-medium text-gray-500">
                            Penulis: John Doe | 8 April 2027
                        </span>

                        <p class="text-[10px] text-black leading-relaxed">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. 
                            In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla 
                            lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel 
                            class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.
                        </p>

                         <p class="text-[10px] text-black leading-relaxed">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. 
                            In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla 
                            lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel 
                            class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.
                        </p>

                         <p class="text-[10px] text-black leading-relaxed">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. 
                            In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla 
                            lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel 
                            class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.
                        </p>

                         <p class="text-[10px] text-black leading-relaxed">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. 
                            In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla 
                            lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel 
                            class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.
                        </p>

                          <p class="text-[10px] text-black leading-relaxed">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. 
                            In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla 
                            lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel 
                            class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.
                        </p>
                    </div>
                </div>
               
            </div>
        </div>

    </div>
</div>