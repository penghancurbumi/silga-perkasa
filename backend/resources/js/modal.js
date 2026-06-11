window.openModal = function(){
    const modal = document.getElementById('modal');
    if (modal) {
        modal.style.display= 'flex';
    }
}

window.closeModal= function(){
    const modal = document.getElementById('modal');
    if (modal) {
        modal.style.display= 'none';
    }
}
