function initCalendar() {
    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return; // skip kalau elemen tidak ada

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },
        height: 'auto',
        fixedWeekCount: true,
        showNonCurrentDates: true,
        dayHeaderFormat: { weekday: 'narrow' },
    });

    calendar.render();

    window.addEventListener('sidebarToggle', () => {
        setTimeout(() => {
            calendar.updateSize();
        }, 320);
    });
}

// Saat pertama load
document.addEventListener('DOMContentLoaded', initCalendar);

// Saat navigasi via wire:navigate
document.addEventListener('livewire:navigated', initCalendar);