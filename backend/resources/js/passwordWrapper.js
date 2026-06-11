document.addEventListener('livewire:navigated', () => {

    const PasswordInput = document.getElementById('password');
    const toggleButton = document.getElementById('togglePassword');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClose = document.getElementById('eyeClose');

    if (toggleButton && PasswordInput) {
        toggleButton.addEventListener('click', () => {
            const isPassword = PasswordInput.type === 'password';
            PasswordInput.type = isPassword ? 'text' : 'password';
            if (eyeOpen) eyeOpen.classList.toggle('hidden', !isPassword);
            if (eyeClose) eyeClose.classList.toggle('hidden', isPassword);
        });
    }

    const ConfirmInput = document.getElementById('Confirmpassword');
    const toggleConfirm = document.getElementById('toggleConfirmpassword');
    const eyeOpenConfirm = document.getElementById('eyeOpenConfirm');
    const eyeCloseConfirm = document.getElementById('eyeCloseConfirm');

    if (toggleConfirm && ConfirmInput) {
        toggleConfirm.addEventListener('click', () => {
            const isPassword = ConfirmInput.type === 'password';
            ConfirmInput.type = isPassword ? 'text' : 'password';
            if (eyeOpenConfirm) eyeOpenConfirm.classList.toggle('hidden', !isPassword);
            if (eyeCloseConfirm) eyeCloseConfirm.classList.toggle('hidden', isPassword);
        });
    }
});    