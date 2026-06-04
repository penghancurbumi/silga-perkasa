import './bootstrap';
import './sidebar'
import './dropdown';
import Alphine from 'alpinejs'

window.Alphine = Alphine

Alphine.start();

document.querySelectorAll('a[wire\\:navigate]').forEach(link => {
    link.addEventListener('click',(e) => {
        if(link.href === window.location.href){
            e.preventDefault()
        }
    })
})