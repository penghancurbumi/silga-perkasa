import { sidebarState } from "./sidebarState";

document.addEventListener('DOMContentLoaded', () => {

    const wrappers = document.querySelectorAll('.dropdown-wrapper');

    wrappers.forEach(wrapper => {
        const button = wrapper.querySelector('.dropdown-button');
        const menu   = wrapper.querySelector('.dropdown-menu');
        const arrow  = wrapper.querySelector('.dropdown-arrow');

        function openDropdown() {
            menu.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        }

        function closeDropdown() {
            menu.classList.add('hidden');
            arrow.classList.remove('rotate-180'); // ✅ fix bug lama
        }

        button.addEventListener('click', (e) => {
            e.stopPropagation(); // cegah event bubble ke document

            if (!sidebarState.expanded) {
                sidebarState.expanded = true;
                document.dispatchEvent(new CustomEvent('sidebar:update'));
            }

            menu.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        });

        // Tutup dropdown kalau klik di luar
                document.addEventListener('click', (e) => {
            if (!wrapper.contains(e.target)) {
                closeDropdown();
            }
        });

        document.addEventListener('sidebar:update', () => {
            if (!sidebarState.expanded) closeDropdown();
        });
    });
});