 document.addEventListener('DOMContentLoaded', () => {

        const sidebar = document.getElementById('sidebar')

        const toggleBtn = document.getElementById('toggleSidebar')

        const expandedLogo = document.getElementById('logoExpanded')
        const collapsedLogo = document.getElementById('logoCollapsed')

        const dropdownButton = document.getElementById('dropdownButton')
        const dropdownMenu = document.getElementById('dropdownMenu')
        const dropdownArrow = document.getElementById('dropdownArrow')

        const sidebarTexts = document.querySelectorAll('.sidebar-text')

        //Semua menu sidebar
        const sidebarLinks = document.querySelectorAll('.nav-link')

        let expanded = localStorage.getItem('sidebar-expanded')

        expanded = expanded === null
            ? true
            : expanded === 'true'

        function updateSidebar() {

            if (expanded) {

                sidebar.classList.remove('w-20')
                sidebar.classList.add('w-64')

                expandedLogo.classList.remove('hidden')
                collapsedLogo.classList.add('hidden')

                toggleBtn.classList.remove('hidden')

                sidebarTexts.forEach(text => {

                    text.classList.remove(
                        'opacity-0',
                        'w-0',
                        'overflow-hidden',
                        '-ml-2'
                    )

                    text.classList.add(
                        'opacity-100',
                        'w-auto'
                    )
                })

            } else {

                sidebar.classList.remove('w-64')
                sidebar.classList.add('w-20')

                expandedLogo.classList.add('hidden')
                collapsedLogo.classList.remove('hidden')

                toggleBtn.classList.add('hidden')

                sidebarTexts.forEach(text => {

                    text.classList.add(
                        'opacity-0',
                        'w-0',
                        'overflow-hidden',
                        '-ml-2'
                    )

                    text.classList.remove(
                        'opacity-100',
                        'w-auto'
                    )
                })

                dropdownMenu.classList.add('hidden')
                dropdownArrow.classList.remove('rotate-180')
            }

            localStorage.setItem('sidebar-expanded', expanded)
        }

        //Toggle manual
        toggleBtn.addEventListener('click', () => {

            expanded = !expanded
            updateSidebar()
        })

        //Klik logo kecil
        collapsedLogo.addEventListener('click', () => {

            expanded = true
            updateSidebar()
        })

        //Dropdown
        dropdownButton.addEventListener('click', () => {

            if (!expanded) {

                expanded = true
                updateSidebar()
            }

            dropdownMenu.classList.toggle('hidden')
            dropdownArrow.classList.toggle('rotate-180')
        })

        //AUTO EXPAND SAAT PINDAH MENU 
        sidebarLinks.forEach(link => {

            link.addEventListener('click', () => {

                if (!expanded) {

                    expanded = true
                    updateSidebar()

                    //Delay supaya animasi width selesai
                    setTimeout(() => {
                        window.location.href = link.href
                    }, 250)

                    return false
                }
            })
        })

        updateSidebar()
    })