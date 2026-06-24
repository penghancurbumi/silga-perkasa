function updateActiveLink() {
    const currentPath = window.location.pathname;

    document.querySelectorAll('#sidebar .nav-link').forEach(link => {
        const linkPath = new URL(link.href).pathname;

        const isActive =
            currentPath === linkPath ||
            currentPath.startsWith(linkPath + '/');

        link.classList.toggle('bg-white', isActive);
        link.classList.toggle('text-black', isActive);

        if (isActive) {
            link.classList.remove('text-white', 'hover:bg-[#1f2733]');
            link.classList.add('pointer-events-none');
        } else {
            link.classList.add('text-white', 'hover:bg-[#1f2733]');
            link.classList.remove('pointer-events-none');
        }
    });
}

document.addEventListener('DOMContentLoaded', updateActiveLink);
document.addEventListener('livewire:navigated', updateActiveLink);