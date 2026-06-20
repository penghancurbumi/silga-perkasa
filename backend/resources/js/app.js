import './sidebar'
import './dropdown';
import './modal';
import './filterButton';
import './contentCreate';
import './passwordWrapper';
import './carouselWrapper';
import './alert';
import './chart';
import Chart from 'chart.js/auto';

window.Chart = Chart;

document.querySelectorAll('a[wire\\:navigate]').forEach(link => {
    link.addEventListener('click', (e) => {
        if (link.href === window.location.href) {
            e.preventDefault()
        }
    })
})