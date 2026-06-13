import './sidebar'
import './modal';
import './filterButton';
import './contentCreate';
import './passwordWrapper';
import './carouselWrapper';
import './alert';

document.querySelectorAll('a[wire\\:navigate]').forEach(link => {
    link.addEventListener('click',(e) => {
        if(link.href === window.location.href){
            e.preventDefault()
        }
    })
})