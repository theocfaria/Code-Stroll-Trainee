function alternaOlho() {
    const senhaInput = document.getElementById('senha');
    const olhoIcon = document.getElementById('olhoIcon');

    if (!senhaInput) return;

    if (senhaInput.type === 'password') {
        senhaInput.type = 'text';
        olhoIcon.classList.replace('bi-eye-slash','bi-eye');
    }
    else if (senhaInput.type === 'text') {
        senhaInput.type = 'password';
        olhoIcon.classList.replace('bi-eye','bi-eye-slash');
    }
}