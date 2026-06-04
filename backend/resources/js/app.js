import './sidebar'
import './dropdown';
import './modal'

document.querySelectorAll('a[wire\\:navigate]').forEach(link => {
    link.addEventListener('click',(e) => {
        if(link.href === window.location.href){
            e.preventDefault()
        }
    })
})