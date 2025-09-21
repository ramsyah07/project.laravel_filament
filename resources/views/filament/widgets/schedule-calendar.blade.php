{{-- School Schedule Calendar Widget - Compact Display --}}
<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center justify-between w-full">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-semibold text-gray-900 dark:text-white">Schedule Calendar</span>
                </div>
                <div class="flex items-center gap-1">
                    <x-filament::badge color="success" size="xs">
                        {{ count($events) }}
                    </x-filament::badge>
                </div>
            </div>
        </x-slot>

        {{-- Compact Calendar Container --}}
        <div class="calendar-compact-container">
            <div id="fullcalendar-{{ $this->getId() }}" class="rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700"></div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
<style>
    .calendar-compact-container {
        width: 100% !important;
        max-height: 350px;
        overflow: hidden;
    }

    /* Compact FullCalendar Styling */
    .fc {
        font-family: inherit;
        background: white;
        border-radius: 0.5rem;
        font-size: 0.75rem;
    }

    .dark .fc {
        background: rgb(17 24 39);
    }

    .fc .fc-toolbar {
        padding: 0.75rem 1rem 0.5rem 1rem;
        margin-bottom: 0;
        background: rgb(249 250 251);
        border-radius: 0.5rem 0.5rem 0 0;
        border-bottom: 1px solid rgb(229 231 235);
    }

    .dark .fc .fc-toolbar {
        background: rgb(31 41 55);
        border-bottom-color: rgb(75 85 99);
    }

    .fc .fc-toolbar-title {
        font-weight: 600;
        font-size: 1rem;
        color: rgb(55 65 81);
        margin: 0;
    }

    .dark .fc .fc-toolbar-title {
        color: rgb(229 231 235);
    }

    .fc .fc-button-primary {
        background-color: rgb(59 130 246);
        border-color: rgb(59 130 246);
        font-size: 0.625rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .fc .fc-button-primary:hover {
        background-color: rgb(37 99 235);
        border-color: rgb(37 99 235);
    }

    .fc .fc-button-primary:disabled {
        background-color: rgb(156 163 175);
        border-color: rgb(156 163 175);
    }

    .fc .fc-col-header {
        background: rgb(249 250 251);
        border-color: rgb(229 231 235);
    }

    .dark .fc .fc-col-header {
        background: rgb(31 41 55);
        border-color: rgb(75 85 99);
    }

    .fc .fc-col-header-cell {
        padding: 0.5rem 0.25rem;
        font-weight: 600;
        font-size: 0.625rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: rgb(107 114 128);
    }

    .dark .fc .fc-col-header-cell {
        color: rgb(156 163 175);
    }

    .fc .fc-daygrid-day {
        background-color: white;
        border-color: rgb(229 231 235);
        min-height: 60px;
    }

    .dark .fc .fc-daygrid-day {
        background-color: rgb(17 24 39);
        border-color: rgb(75 85 99);
    }

    .fc .fc-daygrid-day-number {
        padding: 0.375rem;
        font-weight: 500;
        font-size: 0.625rem;
        color: rgb(55 65 81);
    }

    .dark .fc .fc-daygrid-day-number {
        color: rgb(229 231 235);
    }

    .fc .fc-day-today {
        background-color: rgb(239 246 255) !important;
        border-color: rgb(59 130 246) !important;
    }

    .dark .fc .fc-day-today {
        background-color: rgb(30 58 138) !important;
        border-color: rgb(147 197 253) !important;
    }

    .fc .fc-day-today .fc-daygrid-day-number {
        color: rgb(37 99 235);
        font-weight: 700;
        background: rgb(59 130 246);
        color: white;
        width: 1.25rem;
        height: 1.25rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0.25rem;
        font-size: 0.625rem;
    }

    .dark .fc .fc-day-today .fc-daygrid-day-number {
        background: rgb(147 197 253);
        color: rgb(30 58 138);
    }

    .fc .fc-daygrid-event {
        border-radius: 0.25rem;
        padding: 1px 4px;
        font-size: 0.625rem;
        font-weight: 500;
        margin: 1px 2px;
        border: none;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        cursor: pointer;
        transition: all 0.1s ease;
    }

    .fc .fc-daygrid-event:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.1);
    }

    .fc .fc-event-title {
        font-weight: 500;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-size: 0.625rem;
    }

    .fc .fc-more-link {
        color: rgb(59 130 246);
        font-weight: 500;
        font-size: 0.625rem;
        padding: 1px 3px;
        border-radius: 0.25rem;
        margin: 1px 2px;
    }

    /* Hide some elements for compact view */
    .fc .fc-toolbar-chunk:last-child {
        display: none; /* Hide view switcher buttons */
    }

    /* Responsive adjustments for compact view */
    @media (max-width: 768px) {
        .fc .fc-toolbar {
            padding: 0.5rem;
        }
        
        .fc .fc-daygrid-day {
            min-height: 40px;
        }
        
        .calendar-compact-container {
            max-height: 250px;
        }
        
        .fc .fc-daygrid-event {
            font-size: 0.5rem;
            padding: 1px 2px;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('fullcalendar-{{ $this->getId() }}');
    if (!calendarEl) {
        console.warn('Calendar element not found');
        return;
    }

    // Get events data
    const events = <?php echo json_encode($events ?? []); ?>;
    
    // Initialize compact FullCalendar
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 320, // Fixed compact height
        aspectRatio: 1.2,
        
        // Simplified header toolbar
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'today'
        },
        
        // Button text customization
        buttonText: {
            today: 'Today'
        },
        
        // Compact view settings
        dayMaxEvents: 2, // Limit events per day
        moreLinkClick: 'popover',
        
        // Events configuration
        events: events,
        eventDisplay: 'block',
        eventStartEditable: false,
        eventDurationEditable: false,
        
        // Interaction settings
        selectable: false,
        weekends: true,
        
        // Compact event styling
        eventDidMount: function(info) {
            const props = info.event.extendedProps || {};
            
            // Simplified tooltip
            const details = [
                `${props.subject_name || 'Subject'}`,
                `${props.time || 'Time'}`
            ].join(' - ');
            
            info.el.setAttribute('title', details);
            info.el.style.cursor = 'pointer';
        },
        
        // Simple event click
        eventClick: function(info) {
            const props = info.event.extendedProps || {};
            alert(`${props.subject_name || 'Subject'}\nTime: ${props.time || 'Unknown'}\nTeacher: ${props.teacher_name || 'Unknown'}`);
        },
        
        // Loading state
        loading: function(isLoading) {
            if (isLoading) {
                calendarEl.classList.add('fc-loading');
            } else {
                calendarEl.classList.remove('fc-loading');
            }
        }
    });

    // Render calendar
    calendar.render();
    
    // Simple resize handling
    window.addEventListener('resize', function() {
        calendar.updateSize();
    });
});
</script>
@endpush

