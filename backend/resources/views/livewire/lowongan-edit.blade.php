@use('Illuminate\Support\Facades\Storage')

<div>
    <div class="flex flex-row items-center justify-between mb-4">
        <div class="flex items-center">
            <h1 class="text-[20px] font-semibold">Create Lowongan</h1>
        </div>

        <div class="flex items-center gap-2">

            <button 
                class="inline-flex items-center px-5 py-2 rounded gap-2 bg-white text-black hover:bg-gray-50
                border border-gray-200 transition cursor-pointer text-[12px]">

                Preview
            </button>

            <button wire:click="save('draft')"
                class="inline-flex items-center px-5 py-2 rounded gap-2 bg-white text-black hover:bg-gray-50
                border border-gray-200 transition cursor-pointer text-[12px]">

                Save as Draft
            </button>
            
            <button wire:click="save('published')"
                class="inline-flex items-center px-5 py-2 rounded gap-2 bg-white text-black hover:bg-gray-50
                border border-gray-200 transition cursor-pointer text-[12px]">

                Publish
            </button>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded p-6 space-y-8">

        <div class="flex items-start justify-between pb-8 border-b border-gray-200 mt-4">
            <div class="flex flex-col">
                <h3 class="text-[15px] font-semibold">Job title</h3>
                <p class="mt-1 text-[10px] font-semibold text-gray-400">Masukkan nama atau judul posisi pekerjaan yang akan dipublikasikan.</p>
            </div>
            
            <div class="flex flex-col gap-1">
                <input
                    type="text"
                    wire:model="title"
                    placeholder="Masukan nama pekerjaan..."
                    class="w-150 bg-white border border-gray-200 px-4 py-2 rounded text-[12px]">
                @error('title')
                    <p class="text-[10px] text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex items-start justify-between pb-8 border-b border-gray-200 mt-4">
            <div class="flex flex-col">
                <h3 class="text-[15px] font-semibold">Category</h3>
                <p class="mt-1 text-[10px] font-semibold text-gray-400">Pilih kategori yang paling sesuai dengan posisi yang dibuka.</p>
            </div>
            
            <div class="flex flex-col gap-1">
                <div class="relative w-150">
                    <select
                        wire:model="job_category_id"
                        class="w-full appearance-none bg-white pl-3 pr-10 text-[12px] border border-gray-200 py-2 rounded cursor-pointer">

                        <option value="">Pilih Kategori</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach

                    </select>

                    <iconify-icon
                        icon="mdi:chevron-down"
                        width="20"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"
                    ></iconify-icon>
                </div>

                @error('job_category_id')
                    <p class="text-[10px] text-red-500">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="flex items-start justify-between pb-8 border-b border-gray-200 mt-4">
            <div class="flex flex-col">
                <h3 class="text-[15px] font-semibold">Tipe</h3>
                <p class="mt-1 text-[10px] font-semibold text-gray-400">Pilih jenis pekerjaan sesuai dengan sistem kerja yang ditawarkan.</p>
            </div>
            
            <div class="w-150 grid grid-cols-3 gap-y-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input wire:model="employment_type" type="radio" value="full_time"
                        class="border border-gray-200 accent-black">
                    <span class="text-[12px] font-semibold">Full time</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input wire:model="employment_type" type="radio" value="part_time"
                        class="border border-gray-200 accent-black">
                    <span class="text-[12px] font-semibold">Part time</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input wire:model="employment_type" type="radio" value="internship"
                        class="border border-gray-200 accent-black">
                    <span class="text-[12px] font-semibold">Internship</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input wire:model="employment_type" type="radio" value="contract"
                        class="border border-gray-200 accent-black">
                    <span class="text-[12px] font-semibold">Contract</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input wire:model="employment_type" type="radio" value="freelance"
                        class="border border-gray-200 accent-black">
                    <span class="text-[12px] font-semibold">Freelance</span>
                </label>
            </div>
            @error('employment_type')
                <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-start justify-between pb-8 border-b border-gray-200 mt-4">
            <div class="flex flex-col">
                <h3 class="text-[15px] font-semibold">Location</h3>
                <p class="mt-1 text-[10px] font-semibold text-gray-400">Tentukan lokasi atau penempatan kerja untuk posisi ini.</p>
            </div>
            
            <div class="flex flex-col gap-1">
                <x-location-select model="location" placeholder="Cari kota atau provinsi..." />
                @error('location')
                    <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex items-start justify-between pb-8 border-b border-gray-200 mt-4">
            <div class="flex flex-col">
                <h3 class="text-[15px] font-semibold">Description</h3>
                <p class="mt-1 text-[10px] font-semibold text-gray-400">Jelaskan tanggung jawab, tugas, dan gambaran umum mengenai posisi ini. lokasi atau penempatan kerja untuk posisi ini.</p>
            </div>
            
            <div class="flex flex-col gap-4">
                <textarea 
                    type="text"
                    wire:model="description"
                    placeholder="Masukan deskripsi lowongan..."
                    class="w-150 h-64 bg-white border border-gray-200 px-4 py-2 rounded resize-none text-[12px]"></textarea>
            </div>
            @error('description')
                <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
             @enderror
        </div>

        <div class="flex items-start justify-between pb-8 border-b border-gray-200 mt-4">
            <div class="flex flex-col">
                <h3 class="text-[15px] font-semibold">Kualifikasi</h3>
                <p class="mt-1 text-[10px] font-semibold text-gray-400">Tuliskan persyaratan, keterampilan, pengalaman, atau kriteria yang harus dipenuhi pelamar.</p>
            </div>
            
            <div class="flex flex-col gap-4">
                <textarea 
                    type="text"
                    placeholder="Masukan kualifikasi..."
                    wire:model="kualifikasi"
                    class="w-150 h-64 bg-white border border-gray-200 px-4 py-2 rounded resize-none text-[12px]"></textarea>
            </div>
        </div>

         <div class="flex items-start justify-between pb-8 border-b border-gray-200 mt-4">
            <div class="flex flex-col">
                <h3 class="text-[15px] font-semibold">Posted At</h3>
                <p class="mt-1 text-[10px] font-semibold text-gray-400">Tentukan tanggal mulai publikasi lowongan kepada calon pelamar.</p>
            </div>
            
            <input 
                type="datetime-local"
                class="w-150 bg-white border border-gray-200 px-4 py-2 rounded text-gray-500 text-[12px]">
        </div>
        
         <div class="flex items-start justify-between pb-8 border-b border-gray-200 mt-4">
            <div class="flex flex-col">
                <h3 class="text-[15px] font-semibold">Deadline</h3>
                <p class="mt-1 text-[10px] font-semibold text-gray-400">Pilih batas akhir penerimaan lamaran untuk posisi ini.</p>
            </div>
            
            <input 
                wire:model="deadline"
                type="datetime-local"
                class="w-150 bg-white border border-gray-200 px-4 py-2 rounded text-gray-500 text-[12px]">
        </div>

         <div class="flex items-start justify-between pb-8 mt-4">
            <div class="flex flex-col">
                <h3 class="text-[15px] font-semibold">Status</h3>
                <p class="mt-1 text-[10px] font-semibold text-gray-400">Atur status lowongan, seperti aktif, draft, atau ditutup sesuai kebutuhan.</p>
            </div>

            <div class="relative w-150">
                <select
                    wire:model="status"
                    class="w-full bg-white appearance-none border border-gray-200 rounded pl-3 pr-10 cursor-pointer text-[12px] py-2">

                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="closed">Closed</option>

                </select>

                <iconify-icon
                    icon="mdi:chevron-down"
                    width="20"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"
                ></iconify-icon>
            </div>
        </div>
        
    </div>

</div>
