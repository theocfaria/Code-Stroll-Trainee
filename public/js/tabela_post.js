const tela = document.getElementById('tela');

function abrirModal(idModal) {
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
}

function definirDataAtual(idCampo) {
  const campo = document.getElementById(idCampo);
  if (!campo) return;
  const hoje = new Date();
  const yyyy = hoje.getFullYear();
  const mm = String(hoje.getMonth() + 1).padStart(2, '0');
  const dd = String(hoje.getDate()).padStart(2, '0');
  campo.value = `${yyyy}-${mm}-${dd}`;
}

function mostrarMensagem(texto, tipo = 'sucesso') {
  const msg = document.createElement('div');
  msg.textContent = texto;
  msg.className = tipo === 'erro' ? 'mensagem-erro' : 'mensagem-sucesso';
  document.body.appendChild(msg);
  setTimeout(() => msg.remove(), 3000);
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

document.addEventListener('DOMContentLoaded', () => {
  const btnConfirmarEditar = document.getElementById('co');
  if (btnConfirmarEditar) {
    btnConfirmarEditar.addEventListener('click', () => {
      const modal = document.getElementById('modal-editar');
      if (!modal) return;
      const inputs = Array.from(modal.querySelectorAll('input[type="text"]'));
      const dateInput = modal.querySelector('input[type="date"]');
      for (let i = 0; i < inputs.length; i++) {
        if (!inputs[i].value || inputs[i].value.trim() === '') {
          exibirErro('modal-editar-erro', 'Preencha todos os campos antes de confirmar.');
          return;
        }
      }
      if (dateInput && !dateInput.value) {
        exibirErro('modal-editar-erro', 'Defina uma data válida.');
        return;
      }
      limparErro('modal-editar-erro');
      mostrarMensagem('Post editado com sucesso!');
      fecharModal('modal-editar');
    });
  }

  const btnConfirmarCriar = document.getElementById('co2');
  if (btnConfirmarCriar) {
    btnConfirmarCriar.addEventListener('click', () => {
      const modal = document.getElementById('modal-criar');
      if (!modal) return;
      const inputs = Array.from(modal.querySelectorAll('input[type="text"]'));
      const dateInput = modal.querySelector('input[type="date"]');
      for (let i = 0; i < inputs.length; i++) {
        if (!inputs[i].value || inputs[i].value.trim() === '') {
          exibirErro('modal-criar-erro', 'Preencha todos os campos antes de confirmar.');
          return;
        }
      }
      if (dateInput && !dateInput.value) {
        exibirErro('modal-criar-erro', 'Defina uma data válida.');
        return;
      }
      limparErro('modal-criar-erro');
      mostrarMensagem('Post criado com sucesso!');
      fecharModal('modal-criar');
    });
  }

  const btnsCancelar = document.querySelectorAll('.btn-cancelar, #sa, #sa2');
  btnsCancelar.forEach(btn => {
    if (!btn) return;
    btn.addEventListener('click', () => {
      const parentModal = btn.closest('.modal') || btn.closest('div[id^="modal"]');
      if (parentModal) {
        const erro = parentModal.querySelector('.erro');
        if (erro) erro.style.display = 'none';
      }
    });
  });

  if (tela) {
    tela.addEventListener('click', () => {
      ['modal-criar', 'modal-editar', 'modal-visualizar', 'modal-delete'].forEach(id => {
        const m = document.getElementById(id);
        if (m && m.style.display === 'flex') m.style.display = 'none';
      });
      tela.style.display = 'none';
    });
  }
});