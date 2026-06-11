import {
    sidebarState,
    registerUpdateSidebar
} from './sidebarState';

document.addEventListener('livewire:navigated', () => {

    const sidebar = document.getElementById('sidebar');

    const toggleBtn = document.getElementById('toggleSidebar');

    const expandedLogo = document.getElementById('logoExpanded');
    const collapsedLogo = document.getElementById('logoCollapsed');

    const sidebarTexts = document.querySelectorAll('.sidebar-text');
    const dropdownArrows = document.querySelectorAll('.dropdown-arrow');

    if (!sidebar || !toggleBtn || !expandedLogo || !collapsedLogo) {
        return;
    }

    function renderSidebar() {

        if (sidebarState.expanded) {

            sidebar.classList.remove('w-20');
            sidebar.classList.add('w-64');

            expandedLogo.classList.remove('hidden');
            collapsedLogo.classList.add('hidden');

            toggleBtn.classList.remove('hidden');

            sidebarTexts.forEach(text => {
                text.classList.remove('hidden');
            });

            dropdownArrows.forEach(arrow => {
                arrow.classList.remove('hidden');
            });

        } else {

            sidebar.classList.remove('w-64');
            sidebar.classList.add('w-20');

            expandedLogo.classList.add('hidden');
            collapsedLogo.classList.remove('hidden');

            toggleBtn.classList.add('hidden');

            sidebarTexts.forEach(text => {
                text.classList.add('hidden');
            });

            dropdownArrows.forEach(arrow => {
                arrow.classList.add('hidden');
            });

            // tutup semua dropdown
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.add('hidden');
            });

            document.querySelectorAll('.dropdown-arrow').forEach(arrow => {
                arrow.classList.remove('rotate-180');
            });
        }
    }

    registerUpdateSidebar(renderSidebar);

    toggleBtn.addEventListener('click', () => {

        sidebarState.expanded = false;

        renderSidebar();
    });

    collapsedLogo.addEventListener('click', () => {

        sidebarState.expanded = true;

        renderSidebar();
    });

    renderSidebar();

});