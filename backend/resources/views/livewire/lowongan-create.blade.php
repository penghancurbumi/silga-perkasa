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
    x-init="
        Livewire.on('lowongan-error', () => showAlert('error', 'Validasi Gagal', 'Silakan periksa kembali form Anda.'));
    "
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

            <button wire:click="save"
                class="inline-flex items-center px-5 py-2 rounded gap-2 bg-black text-white hover:bg-gray-800
                border border-transparent transition cursor-pointer text-[12px]">

                Simpan
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
                    class="w-150 bg-white border px-4 py-2 rounded text-[12px]
                    {{ $errors->has('title') ? 'border-red-500' : 'border-gray-200' }}">
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
                        class="w-full appearance-none bg-white pl-3 pr-10 text-[12px] border py-2 rounded cursor-pointer
                        {{ $errors->has('job_category_id') ? 'border-red-500' : 'border-gray-200' }}">

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
            
            <div class="flex flex-col gap-1">
                <div class="w-150 grid grid-cols-3 gap-y-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input wire:model="employment_type" type="radio" value="full_time"
                            class="border accent-black
                            {{ $errors->has('employment_type') ? 'border-red-500' : 'border-gray-200' }}">
                        <span class="text-[12px] font-semibold">Full time</span>
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input wire:model="employment_type" type="radio" value="part_time"
                            class="border accent-black
                            {{ $errors->has('employment_type') ? 'border-red-500' : 'border-gray-200' }}">
                        <span class="text-[12px] font-semibold">Part time</span>
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input wire:model="employment_type" type="radio" value="internship"
                            class="border accent-black
                            {{ $errors->has('employment_type') ? 'border-red-500' : 'border-gray-200' }}">
                        <span class="text-[12px] font-semibold">Internship</span>
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input wire:model="employment_type" type="radio" value="contract"
                            class="border accent-black
                            {{ $errors->has('employment_type') ? 'border-red-500' : 'border-gray-200' }}">
                        <span class="text-[12px] font-semibold">Contract</span>
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input wire:model="employment_type" type="radio" value="freelance"
                            class="border accent-black
                            {{ $errors->has('employment_type') ? 'border-red-500' : 'border-gray-200' }}">
                        <span class="text-[12px] font-semibold">Freelance</span>
                    </label>
                </div>
                @error('employment_type')
                    <p class="text-[10px] text-red-500">{{ $message }}</p>
                @enderror
            </div>
           
        </div>

        <div class="flex items-start justify-between pb-8 border-b border-gray-200 mt-4">
            <div class="flex flex-col">
                <h3 class="text-[15px] font-semibold">Location</h3>
                <p class="mt-1 text-[10px] font-semibold text-gray-400">Tentukan lokasi atau penempatan kerja untuk posisi ini.</p>
            </div>
            
            <div class="flex flex-col gap-1">
                <x-location-select model="location" placeholder="Cari kota atau provinsi..." />
                @error('location')
                    <p class="text-[10px] text-red-500">{{ $message }}</p>
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
                    class="w-150 h-64 bg-white border px-4 py-2 rounded resize-none text-[12px]
                    {{ $errors->has('description') ? 'border-red-500' : 'border-gray-200' }}"></textarea>
                @error('description')
                    <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex items-start justify-between pb-8 border-b border-gray-200 mt-4">
            <div class="flex flex-col">
                <h3 class="text-[15px] font-semibold">Kualifikasi</h3>
                <p class="mt-1 text-[10px] font-semibold text-gray-400">Tuliskan persyaratan, keterampilan, pengalaman, atau kriteria yang harus dipenuhi pelamar.</p>
            </div>
            
            <div class="flex flex-col gap-1 w-150" wire:ignore>
                <div x-data="{
                    content: @entangle('kualifikasi'),
                    quill: null,
                    init() {
                        this.quill = new Quill(this.$refs.quillEditor, {
                            theme: 'snow',
                            modules: {
                                toolbar: [
                                    ['bold', 'italic', 'underline'],
                                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                                    ['clean']
                                ]
                            }
                        });
                        this.quill.root.innerHTML = this.content || '';
                        this.quill.on('text-change', () => {
                            this.content = this.quill.root.innerHTML;
                        });
                    }
                }">
                    <div x-ref="quillEditor" class="bg-white"></div>
                </div>
                @error('kualifikasi')
                    <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex items-start justify-between pb-8 border-b border-gray-200 mt-4">
            <div class="flex flex-col">
                <h2 class="text-[15px] font-semibold">Skill</h2>
                <p class="mt-1 text-[10px] font-semibold text-gray-400">Tentukan skill yang dibutuhkan untuk lowongan yang akan dibuat.</p>
            </div>

            <div class="flex flex-col gap-2 w-150" x-data="{
                newSkill: '',
                skills: @entangle('skills').live,
                addSkill() {
                    let val = this.newSkill.trim();
                    if (val !== '' && !this.skills.includes(val)) {
                        this.skills.push(val);
                    }
                    this.newSkill = '';
                },
                removeSkill(index) {
                    this.skills.splice(index, 1);
                }
            }">
                <div class="flex gap-2">
                    <input 
                        type="text"
                        x-model="newSkill"
                        @keydown.enter.prevent="addSkill()"
                        placeholder="Ketik nama skill lalu tekan Enter..."
                        class="w-full bg-white border px-4 py-2 rounded text-[12px] focus:outline-none focus:border-gray-400 transition-colors {{ $errors->has('skills') ? 'border-red-500' : 'border-gray-200' }}"
                    >
                    <button type="button" @click="addSkill()" class="px-4 py-2 bg-black text-white text-[12px] rounded hover:bg-gray-800 transition">Add</button>
                </div>
                
                <div class="flex flex-wrap gap-2 mt-2" x-show="skills.length > 0" x-cloak>
                    <template x-for="(skill, index) in skills" :key="index">
                        <div class="flex items-center gap-1 bg-gray-100 border border-gray-200 px-3 py-1 rounded-full text-[11px] text-gray-700">
                            <span x-text="skill"></span>
                            <button type="button" @click="removeSkill(index)" class="text-gray-400 hover:text-red-500 transition-colors cursor-pointer ml-1">
                                <iconify-icon icon="mdi:close" width="12"></iconify-icon>
                            </button>
                        </div>
                    </template>
                </div>
                @error('skills')
                    <p class="text-[10px] text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

         <div class="flex items-start justify-between pb-8 border-b border-gray-200 mt-4">
            <div class="flex flex-col">
                <h2 class="text-[15px] font-semibold">Posted At</h2>
                <p class="mt-1 text-[10px] font-semibold text-gray-400">Tentukan tanggal mulai publikasi lowongan kepada calon pelamar.</p>
            </div>
            
            <div class="flex flex-col gap-1">
                <input
                    wire:model="posted_at"
                    type="datetime-local"
                    class="w-150 bg-white border px-4 py-2 rounded text-gray-500 text-[12px]
                    {{ $errors->has('posted_at') ? 'border-red-500' : 'border-gray-200' }}">
                @error('posted_at')
                    <p class="text-[10px] text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
         <div class="flex items-start justify-between pb-8 border-b border-gray-200 mt-4">
            <div class="flex flex-col">
                <h2 class="text-[15px] font-semibold">Deadline</h2>
                <p class="mt-1 text-[10px] font-semibold text-gray-400">Pilih batas akhir penerimaan lamaran untuk posisi ini.</p>
            </div>
            
            <div class="flex flex-col gap-1">
                <input
                    wire:model="deadline"
                    type="datetime-local"
                    class="w-150 bg-white border px-4 py-2 rounded text-gray-500 text-[12px]
                    {{ $errors->has('deadline') ? 'border-red-500' : 'border-gray-200' }}">
                @error('deadline')
                    <p class="text-[10px] text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

         <div class="flex items-start justify-between pb-8 mt-4">
            <div class="flex flex-col">
                <h2 class="text-[15px] font-semibold">Status</h2>
                <p class="mt-1 text-[10px] font-semibold text-gray-400">Atur status lowongan, seperti aktif, draft, atau ditutup sesuai kebutuhan.</p>
            </div>

            <div class="flex flex-col gap-1">
                <div class="relative w-150">
                    <select
                        wire:model="status"
                        class="w-full bg-white appearance-none border px-4 py-2 rounded text-gray-500 text-[12px]
                        {{ $errors->has('status') ? 'border-red-500' : 'border-gray-200' }}">

                        <option value="">Select Status</option>
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
                
                @error('status')
                    <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
    </div>

</div>
