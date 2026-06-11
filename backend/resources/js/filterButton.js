document.addEventListener('livewire:navigated', () => {

    const dropdownWrappers = document.querySelectorAll('.filter-wrapper')

    dropdownWrappers.forEach(wrapper => {
        const button = wrapper.querySelector('.filter-button')
        const menu = wrapper.querySelector('.filter-menu')
        const arrow = wrapper.querySelector('.filter-arrow')

        if (button && menu) {
            button.addEventListener('click', () => {
                const isOpen = !menu.classList.contains('hidden');
                isOpen ? closeDropdown(menu, arrow) : openDropdown(menu, arrow)
            })
        }
    })

    function openDropdown(menu, arrow) {
        menu.classList.remove('hidden')
        if (arrow) arrow.classList.add('rotate-180')
    }

    function closeDropdown(menu, arrow) {
        menu.classList.add('hidden')
        if (arrow) arrow.classList.remove('rotate-180')
    }
})