{{-- resources/views/filament/widgets/student-chart-widget.blade.php --}}

<x-filament-widgets::widget class="col-span-full">
<div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm ring-1 ring-gray-200/60 dark:ring-white/10 p-3 w-full max-w-5xl mx-auto">
<div class="flex items-center justify-between mb-3">
<h2 class="text-[15px] font-semibold tracking-tight">📊 Student Dashboard Overview</h2>
<span class="text-[10px] text-gray-500 dark:text-gray-400">Realtime summary</span>
</div>

    <div class="grid grid-cols-3 gap-2">
        {{-- Students card --}}
        <div class="relative overflow-hidden rounded-lg bg-white dark:bg-gray-950 shadow-sm ring-1 ring-gray-200/70 dark:ring-white/10 p-3">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-[11px] font-medium text-gray-500 dark:text-gray-400">Total Students</h3>
                    <p class="mt-1 text-xl font-semibold tracking-tight">{{ $stats['students'] }}</p>
                </div>
                <div class="shrink-0 h-6 w-6 grid place-items-center rounded-md bg-red-500/10 text-red-600">👩‍🎓</div>
            </div>
            <div class="mt-2 flex items-center gap-1.5 text-red-600">
                <span class="text-[11px]">Jumlah seluruh siswa</span>
                <span class="text-sm leading-none">↘︎</span>
            </div>
        </div>

        {{-- Teachers card --}}
        <div class="relative overflow-hidden rounded-lg bg-white dark:bg-gray-950 shadow-sm ring-1 ring-gray-200/70 dark:ring-white/10 p-3">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-[11px] font-medium text-gray-500 dark:text-gray-400">Total Teachers</h3>
                    <p class="mt-1 text-xl font-semibold tracking-tight">{{ $stats['teachers'] }}</p>
                </div>
                <div class="shrink-0 h-6 w-6 grid place-items-center rounded-md bg-blue-600/10 text-blue-600">👨‍🏫</div>
            </div>
            <div class="mt-2 flex items-center gap-1.5 text-blue-600">
                <span class="text-[11px]">Jumlah seluruh guru</span>
                <span class="text-sm leading-none">👥</span>
            </div>
        </div>

        {{-- Classrooms card --}}
        <div class="relative overflow-hidden rounded-lg bg-white dark:bg-gray-950 shadow-sm ring-1 ring-gray-200/70 dark:ring-white/10 p-3">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-[11px] font-medium text-gray-500 dark:text-gray-400">Total Classrooms</h3>
                    <p class="mt-1 text-xl font-semibold tracking-tight">{{ $stats['classrooms'] }}</p>
                </div>
                <div class="shrink-0 h-6 w-6 grid place-items-center rounded-md bg-orange-500/10 text-orange-500">🏫</div>
            </div>
            <div class="mt-2 flex items-center gap-1.5 text-orange-500">
                <span class="text-[11px]">Jumlah seluruh kelas</span>
                <span class="text-sm leading-none">🎓</span>
            </div>
        </div>
    </div>
</div>


</x-filament-widgets::widget>


