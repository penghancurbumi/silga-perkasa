document.addEventListener('livewire:init', () => {

    function showAlert(id, redirect = null) {
        const alert = document.getElementById(id);
        if (!alert) return;

        alert.classList.remove('hidden');

        if (redirect) {
            setTimeout(() => {
                window.location.href = redirect;
            }, 5000)
        }
    }

    //AUth
    Livewire.on('login-success', () => showAlert('alert', '/'));
    Livewire.on('register-success', () => showAlert('alert', '/login'));

    //published 
    Livewire.on('published-success', () => showAlert('alert-published', '/content'));
    Livewire.on('published-error-1', () => showAlert('alert-published-error-1'));
    Livewire.on('published-error-2', () => showAlert('alert-published-error-2'));

    //draft
    Livewire.on('draft-success', () => showAlert('alert-draft', '/content'));
    Livewire.on('draft-error-1', () => showAlert('alert-draft-error-1'));
    Livewire.on('draft-error-2', () => showAlert('alert-draft-error-2'));

    //scheduled
    Livewire.on('scheduled-success', () => showAlert('alert-scheduled', '/content'));
    Livewire.on('scheduled-error-1', () => showAlert('alert-scheduled-error-1'));
    Livewire.on('scheduled-error-2', () => showAlert('alert-scheduled-error-2'));

    //edit 
    Livewire.on('edit-success', () => showAlert('alert-edit', '/content'));
    Livewire.on('edit-error', () => showAlert('alert-edit-error'));

    //settings
    Livewire.on('settings-success', () => {
        showAlert('alert-profile');
        showAlert('alert-settings');
        setTimeout(() => {
            window.location.reload();
        }, 1500);
    });
});

window.closeAlert = function () {
    document.querySelectorAll('[id^="alert"]').forEach(el => {
        el.classList.add('hidden');
    })
}