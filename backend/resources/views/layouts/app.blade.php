<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silga Perkasa Dashboard</title>
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    
    @vite(['resources/css/app.css', 'resources/css/calendar.css', 'resources/js/app.js', 'resources/js/calendar.js'])
    @livewireStyles

    <!-- Quill Editor -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <style>
        .ql-editor {
            min-height: 200px;
            font-size: 12px;
            font-family: inherit;
        }
        .ql-toolbar {
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
            background-color: white;
        }
        .ql-container {
            border-bottom-left-radius: 0.375rem;
            border-bottom-right-radius: 0.375rem;
            background-color: white;
        }
    </style>
</head>
    
<body class="bg-white">

    <!-- Global Alert System -->
    <div x-data="{
            alerts: [],
            addAlert(type, title, message) {
                const id = Date.now();
                this.alerts.push({ id, type, title, message });
                setTimeout(() => this.removeAlert(id), 4000);
            },
            removeAlert(id) {
                this.alerts = this.alerts.filter(a => a.id !== id);
            }
        }"
        x-init="
            {{-- Session flash alerts (after redirect) --}}
            @if(session()->has('success'))
                addAlert('success', 'Success', '{{ session('success') }}');
            @endif
            @if(session()->has('error'))
                addAlert('error', 'Error', '{{ session('error') }}');
            @endif
            @if(session()->has('info'))
                addAlert('info', 'Info', '{{ session('info') }}');
            @endif

            {{-- Livewire event alerts (without redirect) --}}
            Livewire.on('alert', (data) => {
                addAlert(data[0].type || 'success', data[0].title || 'Notification', data[0].message || '');
            });
        "
        class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 pointer-events-none"
    >
        <template x-for="alert in alerts" :key="alert.id">
            <div x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-x-8"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 translate-x-8"
                 class="pointer-events-auto bg-white p-4 rounded-lg border border-gray-200 shadow-lg min-w-[320px]">
                <div class="flex flex-row space-x-3">
                    <!-- Icon -->
                    <template x-if="alert.type === 'success'">
                        <iconify-icon icon="mdi:tick" width="15" class="text-green-500 border border-gray-200 p-2 rounded-lg bg-green-100"></iconify-icon>
                    </template>
                    <template x-if="alert.type === 'error'">
                        <iconify-icon icon="gridicons:cross" width="15" class="text-red-500 border border-gray-200 p-2 rounded-lg bg-red-100"></iconify-icon>
                    </template>
                    <template x-if="alert.type === 'info'">
                        <iconify-icon icon="material-symbols:draft" width="15" class="text-blue-500 border border-gray-200 p-2 rounded-lg bg-blue-100"></iconify-icon>
                    </template>
                    <template x-if="alert.type === 'warning'">
                        <iconify-icon icon="gridicons:scheduled" width="15" class="text-orange-500 border border-gray-200 p-2 rounded-lg bg-orange-100"></iconify-icon>
                    </template>

                    <!-- Text -->
                    <div class="flex flex-col flex-1">
                        <p class="text-[12px] font-semibold" x-text="alert.title"></p>
                        <p class="text-[10px] font-semibold text-gray-400" x-text="alert.message"></p>
                    </div>

                    <!-- Close -->
                    <button @click="removeAlert(alert.id)" class="self-start -mt-1 cursor-pointer text-gray-500 hover:text-gray-400">
                        <iconify-icon icon="gridicons:cross" width="15"></iconify-icon>
                    </button>
                </div>
            </div>
        </template>
    </div>

    <div class="flex h-screen">
        @include('components.sidebar')

        <div class="flex flex-col flex-1">
            @include('components.navbar')

            <main class="px-5 py-4 overflow-y-auto flex flex-col flex-1 min-h-0">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

    @livewireScripts
    @livewireScriptConfig

</body>
</html>