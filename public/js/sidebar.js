const buttonToggle = document.querySelector('.toggle-sidebar');

buttonToggle.addEventListener('click', () => {
    document.querySelector('.sidebar').classList.toggle('closed-sidebar');
})