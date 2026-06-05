import { sidebarState } from './sidebarState';

document.addEventListener('DOMContentLoaded', () => {

    const wrappers = document.querySelectorAll('.dropdown-wrapper');

    wrappers.forEach(wrapper => {

        const button = wrapper.querySelector('.dropdown-button');
        const menu = wrapper.querySelector('.dropdown-menu');
        const arrow = wrapper.querySelector('.dropdown-arrow');

        button.addEventListener('click', () => {

            // sidebar sedang collapse
            if (!sidebarState.expanded) {

                sidebarState.expanded = true;

                const sidebar = document.getElementById('sidebar');
                const toggleBtn = document.getElementById('toggleSidebar');
                const expandedLogo = document.getElementById('logoExpanded');
                const collapsedLogo = document.getElementById('logoCollapsed');

                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-64');

                expandedLogo.classList.remove('hidden');
                collapsedLogo.classList.add('hidden');

                toggleBtn.classList.remove('hidden');

                document.querySelectorAll('.sidebar-text').forEach(text => {
                    text.classList.remove('hidden');
                });

                document.querySelectorAll('.dropdown-arrow').forEach(a => {
                    a.classList.remove('hidden');
                });

                setTimeout(() => {
                    menu.classList.remove('hidden');
                    arrow.classList.add('rotate-180');
                }, 300);

                return;
            }

            menu.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');

        });

    });

});