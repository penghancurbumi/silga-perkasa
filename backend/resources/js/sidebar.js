 import { sidebarState } from './sidebarState'
 
 document.addEventListener('DOMContentLoaded', () => {

        const sidebar = document.getElementById('sidebar')
        const toggleBtn = document.getElementById('toggleSidebar')
        const expandedLogo = document.getElementById('logoExpanded')
        const collapsedLogo = document.getElementById('logoCollapsed')
        const sidebarTexts = document.querySelectorAll('.sidebar-text') 
        const sidebarLinks = document.querySelectorAll('.nav-link')

        sidebarState.expanded = localStorage.getItem('sidebar-expanded')
            ?  localStorage.getItem('sidebar-expanded') === 'true'
            : true

        function updateSidebar() {

            if (sidebarState.expanded) {

                sidebar.classList.replace('w-20','w-64')
                expandedLogo.classList.remove('hidden')
                collapsedLogo.classList.add('hidden')

            } else {

                sidebar.classList.replace('w-64', 'w-20')
                expandedLogo.classList.add('hidden')
                collapsedLogo.classList.remove('hidden')
            }

            localStorage.setItem('sidebar-expanded', sidebarState.expanded)
            document.dispatchEvent(new CustomEvent('sidebar:update'))
        }

        //Toggle manual
        toggleBtn.addEventListener('click', () => {

           sidebarState.expanded = !sidebarState.expanded
            updateSidebar()
        });

        collapsedLogo.addEventListener('click', () => {
            sidebarState.expanded = true;
            updateSidebar()
        })

        updateSidebar()
    })