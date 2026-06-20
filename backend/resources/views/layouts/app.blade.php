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
    
<body class="bg-white">
    
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