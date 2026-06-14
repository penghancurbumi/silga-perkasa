// Update active nav link berdasarkan URL saat navigasi wire:navigate
// (@persist menjaga DOM sidebar, sehingga Blade active state tidak diperbarui otomatis)
function updateActiveLink() {
    const currentPath = window.location.pathname;

    document.querySelectorAll('#sidebar .nav-link').forEach(link => {
        const linkPath = link.pathname;
        if (!linkPath) return;

        const isActive = linkPath === '/'
            ? currentPath === '/'
            : currentPath === linkPath || currentPath.startsWith(linkPath + '/');

        if (isActive) {
            link.classList.add('bg-white', 'text-black');
            link.classList.remove('text-white', 'hover:bg-[#1f2733]');
        } else {
            link.classList.remove('bg-white', 'text-black');
            link.classList.add('text-white', 'hover:bg-[#1f2733]');
        }
    });
}

document.addEventListener('livewire:navigated', updateActiveLink);