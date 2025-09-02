{{-- resources/views/filament/widgets/schedule-calendar.blade.php --}}

<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Header dengan judul dan tombol navigate --}}
        <x-slot name="heading">
            📅 Schedule Calendar
        </x-slot>
        
        <x-slot name="headerEnd">
            {{-- Tombol untuk ke halaman schedule lengkap --}}
            <x-filament::button 
                tag="a" 
                href="{{ url('/admin/schedules') }}"
                size="sm"
                color="primary"
                icon="heroicon-o-calendar-days"
            >
                View All Schedules
            </x-filament::button>
        </x-slot>

        <div class="space-y-4">
            {{-- FullCalendar Container --}}
            <div id="calendar-widget" 
                 class="bg-white dark:bg-gray-900 rounded-lg"
                 data-events="{{ json_encode($events) }}">
            </div>
            
            {{-- Loading state --}}
            <div id="calendar-loading" class="text-center py-8">
                <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-primary-500 bg-primary-50 dark:bg-primary-900/50 transition ease-in-out duration-150">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Loading calendar...
                </div>
            </div>
            
            {{-- Legend untuk warna --}}
            <div class="border-t pt-4 dark:border-gray-700">
                <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">Subject Colors:</h4>
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium" style="background-color: #2563eb20; color: #2563eb;">
                        <span class="w-2 h-2 rounded-full mr-1" style="background-color: #2563eb;"></span>
                        Matematika
                    </span>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium" style="background-color: #dc262620; color: #dc2626;">
                        <span class="w-2 h-2 rounded-full mr-1" style="background-color: #dc2626;"></span>
                        Fisika
                    </span>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium" style="background-color: #05966920; color: #059669;">
                        <span class="w-2 h-2 rounded-full mr-1" style="background-color: #059669;"></span>
                        Kimia
                    </span>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium" style="background-color: #7c3aed20; color: #7c3aed;">
                        <span class="w-2 h-2 rounded-full mr-1" style="background-color: #7c3aed;"></span>
                        Biologi
                    </span>
                </div>
            </div>
        </div>
    </x-filament::section>

    {{-- Include FullCalendar CSS & JS --}}
    @push('styles')
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
    @endpush

    @push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const calendarEl = document.getElementById('calendar-widget');
                const loadingEl = document.getElementById('calendar-loading');
                
                // Get events from data attribute
                const eventsData = calendarEl.getAttribute('data-events');
                const events = eventsData ? JSON.parse(eventsData) : [];
                
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    height: 500,
                    events: events,
                    
                    // Styling
                    themeSystem: 'standard',
                    
                    // Event interaction
                    eventClick: function(info) {
                        const event = info.event;
                        const props = event.extendedProps;
                        
                        // Custom modal atau alert
                        alert(`📚 ${props.subject}\n🏫 Classroom: ${props.classroom}\n👨‍🏫 Teacher: ${props.teacher}\n📅 Day: ${props.day}\n⏰ Time: ${props.time}`);
                    },
                    
                    // Hover effect
                    eventMouseEnter: function(info) {
                        info.el.style.cursor = 'pointer';
                        info.el.style.opacity = '0.8';
                    },
                    
                    eventMouseLeave: function(info) {
                        info.el.style.opacity = '1';
                    },
                    
                    // Loading states
                    loading: function(isLoading) {
                        if (isLoading) {
                            loadingEl.style.display = 'block';
                            calendarEl.style.display = 'none';
                        } else {
                            loadingEl.style.display = 'none';
                            calendarEl.style.display = 'block';
                        }
                    },
                    
                    // Responsive
                    windowResize: function() {
                        calendar.updateSize();
                    },
                    
                    // Dark mode support
                    eventDidMount: function(info) {
                        // Detect dark mode
                        const isDark = document.documentElement.classList.contains('dark');
                        if (isDark) {
                            info.el.style.borderColor = '#374151';
                        }
                    }
                });

                calendar.render();
                
                // Dark mode observer
                const observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        if (mutation.attributeName === 'class') {
                            calendar.render();
                        }
                    });
                });
                
                observer.observe(document.documentElement, {
                    attributes: true,
                    attributeFilter: ['class']
                });
            });
        </script>
    @endpush
</x-filament-widgets::widget>




