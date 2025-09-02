<x-filament-widgets::widget class="col-span-full">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm ring-1 ring-gray-200/60 dark:ring-white/10 p-6 w-full">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold tracking-tight">📅 Schedule Calendar</h2>
            <div class="hidden sm:flex items-center gap-3 text-xs text-gray-500 dark:text-gray-400">
                <span class="inline-flex items-center gap-1"><span class="h-2 w-2 rounded-full bg-blue-600"></span> Lesson</span>
            </div>
        </div>

        <div 
            x-data 
            x-init="
                const initCalendar = () => {
                    const calendarEl = $refs.fc;
                    if (!calendarEl) return;

                    const events = @js($events ?? []);

                    const calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                        },
                        events: events,
                        eventColor: '#2563eb',
                        eventTextColor: '#ffffff',
                        height: 'auto',
                        expandRows: true,
                        nowIndicator: true,
                        slotMinTime: '06:00:00',
                        slotMaxTime: '20:00:00',
                        eventDidMount: function(info) {
                            const props = info.event.extendedProps || {};
                            const details = [
                                props.day ? `Day: ${props.day}` : null,
                                props.time ? `Time: ${props.time}` : null,
                                props.classroom_id ? `Classroom ID: ${props.classroom_id}` : null,
                                props.teacher_id ? `Teacher ID: ${props.teacher_id}` : null,
                                props.subject_id ? `Subject ID: ${props.subject_id}` : null,
                            ].filter(Boolean).join('\n');
                            if (details) {
                                info.el.setAttribute('title', details);
                            }
                            info.el.classList.add('hover:opacity-90');
                        },
                    });

                    calendar.render();
                    window.addEventListener('resize', () => calendar.updateSize());
                };

                const ensureCss = () => {
                    if (!document.querySelector('link[data-fullcalendar-css]')) {
                        const l = document.createElement('link');
                        l.rel = 'stylesheet';
                        l.href = 'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css';
                        l.setAttribute('data-fullcalendar-css', '1');
                        document.head.appendChild(l);
                    }
                };

                const ensureScriptThenInit = () => {
                    if (typeof FullCalendar !== 'undefined') {
                        initCalendar();
                        return;
                    }
                    if (!document.querySelector('script[data-fullcalendar-js]')) {
                        const s = document.createElement('script');
                        s.src = 'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js';
                        s.setAttribute('data-fullcalendar-js', '1');
                        s.onload = initCalendar;
                        document.head.appendChild(s);
                    } else {
                        const poll = setInterval(() => {
                            if (typeof FullCalendar !== 'undefined') {
                                clearInterval(poll);
                                initCalendar();
                            }
                        }, 50);
                        setTimeout(() => clearInterval(poll), 5000);
                    }
                };

                ensureCss();
                ensureScriptThenInit();
            "
            class="calendar-container"
        >
            <div x-ref="fc"></div>
        </div>
    </div>
</x-filament-widgets::widget>

@push('styles')
<style>
.calendar-container {
    width: 100% !important;
    min-height: 760px;
}

/* Light/Dark tweaks for FullCalendar to match Filament */
.fc .fc-toolbar-title {
    font-weight: 600;
}
.fc .fc-daygrid-event {
    border-radius: 0.5rem;
    padding: 2px 6px;
}
.fc .fc-button-primary {
    background-color: #111827;
    border-color: #111827;
}
.dark .fc .fc-button-primary {
    background-color: #374151;
    border-color: #374151;
}
</style>
@endpush

