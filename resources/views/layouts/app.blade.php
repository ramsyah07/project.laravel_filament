<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    {{-- ✅ FullCalendar CSS Global --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css">
    @stack('styles')

</head>
<body class="antialiased">

    <div class="min-h-screen bg-gray-100">
        {{-- Navbar / Sidebar / Content --}}
        {{ $slot }}
    </div>

    @livewireScripts

    {{-- ✅ FullCalendar JS Global --}}
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    {{-- Script tambahan Livewire/Alpine --}}
    @stack('scripts')

</body>
</html>
