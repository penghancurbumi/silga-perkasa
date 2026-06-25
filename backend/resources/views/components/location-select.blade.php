@props([
    'model' => null,       // wire:model name (string), opsional
    'placeholder' => 'Cari kota atau provinsi...',
    'name' => 'location',
])

<div
    x-data="{
        value: @if($model) @entangle($model) @else '' @endif,
        search: '',
        selected: '',
        open: false,
        cities: [],

        init() {
            // Load existing data if editing
            if (this.value) {
                this.search = this.value;
                this.selected = this.value;
            }

            fetch('/data/cities.json')
                .then(r => r.json())
                .then(data => { this.cities = data; });
        },

        get filtered() {
            if (!this.search) return this.cities.slice(0, 10);
            const q = this.search.toLowerCase();
            return this.cities
                .filter(c =>
                    c.city.toLowerCase().includes(q) ||
                    c.province.toLowerCase().includes(q)
                )
                .slice(0, 10);
        },

        select(city, province) {
            this.selected = city + ', ' + province;
            this.search = this.selected;
            this.value = this.selected;
            this.open = false;
        },

        clear() {
            this.search = '';
            this.selected = '';
            this.value = '';
            this.open = true;
        },
        
        handleInput() {
            this.open = true;
            this.value = this.search;
            // if they clear input manually, clear selected status
            if(this.search === '') {
                this.selected = '';
            }
        }
    }"
    x-init="init()"
    @click.outside="open = false"
    class="relative w-150"
>
    {{-- Input --}}
    <div class="relative">
        <iconify-icon
            icon="humbleicons:location"
            width="16"
            class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"
        ></iconify-icon>

        <input
            type="text"
            name="{{ $name }}"
            x-model="search"
            @focus="open = true"
            @input="handleInput()"
            placeholder="{{ $placeholder }}"
            autocomplete="off"
            class="w-full bg-white border pl-9 pr-9 py-2 rounded text-[12px]
                   focus:outline-none focus:border-gray-400 transition-colors
                   {{ $errors->has('location') ? 'border-red-500' : 'border-gray-200' }}"
        >

        {{-- Clear button --}}
        <button
            x-show="selected"
            x-cloak
            @click="clear()"
            type="button"
            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
        >
            <iconify-icon icon="material-symbols:close" width="14"></iconify-icon>
        </button>

        {{-- Chevron (kalau belum ada selected) --}}
        <iconify-icon
            x-show="!selected"
            icon="mdi:chevron-down"
            width="16"
            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"
        ></iconify-icon>
    </div>

    {{-- Hidden input untuk form submission --}}
    @if(!$model)
        <input type="hidden" name="{{ $name }}" x-bind:value="selected">
    @endif

    {{-- Dropdown list --}}
    <div
        x-show="open && filtered.length > 0"
        x-cloak
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute z-50 mt-1 w-full bg-white border border-gray-200 rounded shadow-lg max-h-56 overflow-y-auto"
    >
        <template x-for="item in filtered" :key="item.city + item.province">
            <button
                type="button"
                @click="select(item.city, item.province)"
                class="w-full flex items-center justify-between px-4 py-2.5 text-left
                       hover:bg-gray-50 transition-colors cursor-pointer"
            >
                <div class="flex items-center gap-2">
                    <iconify-icon icon="humbleicons:location" width="14" class="text-gray-400 flex-shrink-0"></iconify-icon>
                    <span class="text-[12px] text-gray-800" x-text="item.city"></span>
                </div>
                <span class="text-[10px] text-gray-400" x-text="item.province"></span>
            </button>
        </template>
    </div>

    {{-- No result --}}
    <div
        x-show="open && search && filtered.length === 0"
        x-cloak
        class="absolute z-50 mt-1 w-full bg-white border border-gray-200 rounded shadow-lg px-4 py-3 text-[12px] text-gray-400"
    >
        Kota tidak ditemukan.
    </div>
</div>
