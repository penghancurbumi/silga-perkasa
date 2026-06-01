<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silga Perkasa Dashboard</title>
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    @vite(['resources/css/app.css', 'resources/css/calendar.css', 'resources/js/app.js', 'resources/js/calendar.js'])
    @livewireStyles
</head>
    
<body class="bg-[#f5f5f5]">
    
    <div class="flex h-screen">
        @include('partials.sidebar')

        <div class="flex flex-col flex-1">
            @include('partials.navbar')

            <main class="px-5 py-4 overflow-y-auto flex flex-col flex-1 min-h-0">
                {{ $slot }}
            </main>
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('sidebarState', () => ({
                expanded: true,
                openDropdown: false,

                init() {
                    const saved = localStorage.getItem('sidebar-expanded')
                    this.expanded = saved === null ? true : JSON.parse(saved)

                    this.$watch('expanded', value => {
                        localStorage.setItem('sidebar-expanded', value)
                    })
                },

                toggleDropdown() {
                    if (!this.expanded) {
                        this.expanded = true
                        this.openDropdown = true
                    } else {
                        this.openDropdown = !this.openDropdown
                    }
                }
            }))
        })
        </script>
    @livewireScripts
    @livewireScriptConfig

</body>
</html>