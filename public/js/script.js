function abrirMenu(menuMostra, menuEsconde) {
    document.getElementById(menuMostra).style.display = "flex";
    document.getElementById(menuEsconde).style.display = "none";
}
function fechaMenu(menuMostra, menuEsconde) {
    document.getElementById(menuMostra).style.display = "none";
    document.getElementById(menuEsconde).style.display = "flex";
}