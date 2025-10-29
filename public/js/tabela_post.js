const tela = document.querySelector('#tela');

function abrirModal(idModal) {

    document.getElementById(idModal).style.display = "flex";
    tela.style.display = "block";

}

function fecharModal(idModal) {

    document.getElementById(idModal).style.display = "none";
    tela.style.display = "none";
}

function definirDataAtual(idCampo) {
    const hoje = new Date();
    const campo = document.getElementById(idCampo);
}