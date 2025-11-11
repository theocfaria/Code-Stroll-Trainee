const tela = document.getElementById('tela');

function abrirModal(idModal) {
  if (idModal === 'modal-criar') {
        definirDataAtual('criar-data');
    }
    const m = document.getElementById(idModal);
    if (!m) return;
    m.style.display = 'flex';
    tela.style.display = 'block';
}

function fecharModal(idModal) {
    const m = document.getElementById(idModal);
    if (!m) return;
    m.style.display = 'none';
    tela.style.display = 'none';
    
    const erro = m.querySelector('.modal-erro');
    if (erro) {
        erro.innerText = '';
        erro.style.display = 'none';
    }
}

function exibirErro(idErro, texto) {
    const el = document.getElementById(idErro);
    if (!el) return;
    el.innerText = texto;
    el.style.display = 'block';
}

function limparErro(idErro) {
    const el = document.getElementById(idErro);
    if (!el) return;
    el.innerText = '';
    el.style.display = 'none';
}

function mostrarMensagem(texto, tipo = 'sucesso') {
    const msg = document.createElement('div');
    msg.textContent = texto;
    msg.className = tipo === 'erro' ? 'mensagem-erro' : 'mensagem-sucesso';
    document.body.appendChild(msg);
    setTimeout(() => msg.remove(), 3000);
}

/**
 * @param {string} idCampo 
 */
function definirDataAtual(idCampo) {
    const campoData = document.getElementById(idCampo);
    if (!campoData) return;

    const hoje = new Date();
    const yyyy = hoje.getFullYear();
    const mm = String(hoje.getMonth() + 1).padStart(2, '0');
    const dd = String(hoje.getDate()).padStart(2, '0');
  
    campoData.value = `${yyyy}-${mm}-${dd}`;
}

function abrirModalVisualizar(id, titulo, autor, data, imagemUrl, descricao) {
    document.getElementById('view-id').textContent = id;
    document.getElementById('view-titulo').textContent = titulo;
    document.getElementById('view-autor').textContent = autor;
    document.getElementById('view-data').textContent = data;
    document.getElementById('view-descricao').textContent = descricao;
    document.getElementById('view-imagem').src = imagemUrl;
    abrirModal('modal-visualizar');
}

function abrirModalEditar(id, titulo, autor, data, imagem, descricao) {
    document.getElementById('editar-id').value = id;
    document.getElementById('editar-titulo').value = titulo;
    document.getElementById('editar-autor').value = autor;
    document.getElementById('editar-data').value = data;
    document.getElementById('editar-imagem').value = imagem;
    document.getElementById('editar-descricao').value = descricao;
    abrirModal('modal-editar');
}

function abrirModalExcluir(id, titulo) {
    const modal = document.getElementById('modal-delete');
    if (!modal) return;
    
    modal.dataset.id = id; 

    const texto = document.getElementById('delete-modal-text');
    if (texto) {
        texto.textContent = `Tem certeza que deseja excluir o post de ID ${id}: "${titulo}"?`;
    }

    abrirModal('modal-delete');
}

function validarFormulario(camposIds, idErro) {
    for (const idCampo of camposIds) {
        const campo = document.getElementById(idCampo);
        if (!campo || !campo.value || campo.value.trim() === '') {
            exibirErro(idErro, 'Preencha todos os campos antes de confirmar.');
            return false;
        }
    }
    limparErro(idErro);
    return true;
}

document.addEventListener('DOMContentLoaded', () => {
    const btnConfirmarCriar = document.getElementById('btn-submit-criar');
    if (btnConfirmarCriar) {
        btnConfirmarCriar.addEventListener('click', () => {
            const camposParaValidar = [
                'criar-imagem',
                'criar-titulo', 
                'criar-descricao',
                'criar-autor', 
                'criar-data'
            ];

            if (validarFormulario(camposParaValidar, 'modal-criar-erro')) {
                console.log('Formulário de CRIAR é válido. Enviando...');
                fecharModal('modal-criar');
                mostrarMensagem('Post criado com sucesso!');
            } else {
                console.log('Formulário de CRIAR inválido.');
            }
        });
    }

    const btnConfirmarEditar = document.getElementById('btn-submit-editar');
    if (btnConfirmarEditar) {
        btnConfirmarEditar.addEventListener('click', () => {
            const camposParaValidar = [
                'editar-imagem',
                'editar-titulo', 
                'editar-descricao',
                'editar-autor', 
                'editar-data'
            ];
            
            if (validarFormulario(camposParaValidar, 'modal-editar-erro')) {
                const id = document.getElementById('editar-id').value;
                console.log(`Formulário de EDITAR é válido. Enviando dados para o ID: ${id}`);
                fecharModal('modal-editar');
                mostrarMensagem('Post editado com sucesso!');
            } else {
                console.log('Formulário de EDITAR inválido.');
            }
        });
    }

    const btnConfirmarExcluir = document.getElementById('btn-submit-excluir');
    if (btnConfirmarExcluir) {
        btnConfirmarExcluir.addEventListener('click', () => {
            const modal = document.getElementById('modal-delete');
            const id = modal.dataset.id;
            console.log(`Enviando solicitação para EXCLUIR o ID: ${id}`);
            fecharModal('modal-delete');
            mostrarMensagem('Post excluído com sucesso!');
        });
    }

    if (tela) {
        tela.addEventListener('click', () => {
            ['modal-criar', 'modal-editar', 'modal-visualizar', 'modal-delete'].forEach(id => {
                const m = document.getElementById(id);
                if (m && m.style.display === 'flex') {
                    fecharModal(id);
                }
            });
        });
    }
});