document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.getElementById('carouselWrapper');
    const indicator = document.getElementById('indicators');

    if (!wrapper) return;

    const total = wrapper.children.length;
    let current = 0;
    let autoplayTimer;

    //drag state
    let startX = 0;
    let isDragging = false;

    const firstClone = wrapper.children[0].cloneNode(true);
    wrapper.appendChild(firstClone)

    //indicator
    Array.from({length:total}).forEach((_,i) => {
        const dot = document.createElement('button');
        dot.className = i === 0
            ? 'w-3 h-3 rounded-full bg-white'
            : 'w-3 h-3 rounded-full bg-white/50';
        dot.addEventListener('click', () => {goTo(i); resetAutoPlay(); });
        indicator.appendChild(dot);
    });

    //core 
    function goTo(index){
        current = index;
        wrapper.style.transition = `transform 700ms ease-in-out`
        wrapper.style.transform = `translateX(-${current * 100}%)`;
        updateDots();
    }

    function updateDots() {
        Array.from(indicator.children).forEach((dot, i) => {
            dot.className = i === current % total
                ? 'w-3 h-3 rounded-full bg-white'
                : 'w-3 h-3 rounded-full bg-white/50'
        })
    }

    wrapper.addEventListener('transitionend', () => {
        if(current === total) {
            wrapper.style.transition = 'none';
            current = 0;
            wrapper.style.transform = `translateX(0%)`
        }
    })

    //mouse drag 
    wrapper.addEventListener('mousedown', (e) => {
        startX = e.clientX;
        isDragging = true;
    });

    wrapper.addEventListener('mouseup', (e) => {
        if(!isDragging) return;
        isDragging = false;

        const diff = startX - e.clientX;

        if (diff > 50) goTo(current + 1);
        else if (diff < -50) goTo(current - 1);

        resetAutoPlay();
    });

    wrapper.addEventListener('mouseleave', () => {
        isDragging = false;
    });

    function startAutoPlay() {
        autoplayTimer = setInterval(() => goTo(current + 1), 4000)
    }

    function resetAutoPlay(){
        clearInterval(autoplayTimer);
        startAutoPlay();
    }

    startAutoPlay();
});