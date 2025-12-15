// ==========================================
// VARIÁVEIS GLOBAIS (Mantidas)
// ==========================================
let idParaExcluir = null;
let idParaEditar = null;
let originalNome = "";
let originalEmail = "";
let originalSenha = "";
let senhaOriginalVisu = "";

// ==========================================
// FUNÇÕES DE MODAL E UTILITÁRIOS
// ==========================================
function abrirModal(idModal) {
  document.querySelector(".pagina_toda").style.display = "block";
  document.getElementById(idModal).style.display = "flex";
}

function fecharModal(idModal) {
  document.querySelector(".pagina_toda").style.display = "block";
  document.getElementById(idModal).style.display = "none";
}

function definirDataAtual(idCampo) {
  const hoje = new Date();
  // Lógica original mantida, embora a variável 'campo' não estivesse sendo usada
  const campo = document.getElementById(idCampo);
}

function togglePasswordVisibility(inputId, iconElement) {
  const input = document.getElementById(inputId);
  if (input.type === "password") {
    input.type = "text";
    iconElement.classList.remove("bi-eye-fill");
    iconElement.classList.add("bi-eye-slash-fill");
  } else {
    input.type = "password";
    iconElement.classList.remove("bi-eye-slash-fill");
    iconElement.classList.add("bi-eye-fill");
  }
}

// ==========================================
// FUNÇÕES DE ERRO
// ==========================================
const erroContainerCriar = document.getElementById("modal-criar-erro");
function exibirErroCriar(mensagem) {
  if (erroContainerCriar) {
    erroContainerCriar.innerText = mensagem;
    erroContainerCriar.style.display = "block";
  }
}
function limparErroCriar() {
  if (erroContainerCriar) {
    erroContainerCriar.innerText = "";
    erroContainerCriar.style.display = "none";
  }
}

const erroContainerEditar = document.getElementById("modal-editar-erro");
function exibirErroEditar(mensagem) {
  if (erroContainerEditar) {
    erroContainerEditar.innerText = mensagem;
    erroContainerEditar.style.display = "block";
  }
}
function limparErroEditar() {
  if (erroContainerEditar) {
    erroContainerEditar.innerText = "";
    erroContainerEditar.style.display = "none";
  }
}

// ==========================================
// NOVAS FUNÇÕES DE VALIDAÇÃO (Para usar no HTML)
// ==========================================

// Esta função deve ser chamada no onsubmit do formulário de CRIAR
function validarFormularioCriar(event) {
  const inputNome = document.getElementById("criar-nome");
  const inputEmail = document.getElementById("criar-email");
  const inputSenha = document.getElementById("criar-senha");
  const inputConfirmarSenha = document.getElementById("criar-confirmar-senha");

  const nome = inputNome.value;
  const email = inputEmail.value;
  const senha = inputSenha.value;
  const confirmarSenha = inputConfirmarSenha.value;

  // Validações
  if (!nome || !email || !senha || !confirmarSenha) {
    exibirErroCriar("Todos os campos são obrigatórios!");
    event.preventDefault(); // Impede o envio
    return false;
  }
  if (nome.length < 3) {
    exibirErroCriar("Erro, nome precisa de no mínimo 3 caracteres!");
    event.preventDefault();
    return false;
  }
  if (!email.includes("@") || !email.includes(".com")) {
    exibirErroCriar("Erro, e-mail inválido!");
    event.preventDefault();
    return false;
  }
  if (email.length < 11) {
    exibirErroCriar("Erro, e-mail precisa de no mínimo 11 caracteres!");
    event.preventDefault();
    return false;
  }
  if (senha.length < 6) {
    exibirErroCriar("Erro, senha precisa de no mínimo 6 caracteres!");
    event.preventDefault();
    return false;
  }

  /* Validações de regex desativadas conforme seu código original
    const specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;
    const numberRegex = /\d/;
    const letterRegex = /[a-zA-Z]/;
    ...
    */

  // Se passou por tudo, limpa erros e deixa o formulário enviar (retorna true)
  limparErroCriar();
  return true;
}

// Esta função deve ser chamada no onsubmit do formulário de EDITAR
function validarFormularioEditar(event) {
  const inputNome = document.getElementById("editar-nome");
  const inputEmail = document.getElementById("editar-email");
  const inputSenha = document.getElementById("editar-senha");
  const inputConfirmarSenha = document.getElementById("editar-confirmar-senha");

  const nome = inputNome.value;
  const email = inputEmail.value;
  const senha = inputSenha.value;
  const confirmarSenha = inputConfirmarSenha.value;

  if (!nome || !email) {
    exibirErroEditar("Nome e E-mail são obrigatórios!");
    event.preventDefault();
    return false;
  }
  if (nome.length < 3) {
    exibirErroEditar("Erro, nome precisa de no mínimo 3 caracteres!");
    event.preventDefault();
    return false;
  }
  if (!email.includes("@") || !email.includes(".com")) {
    exibirErroEditar("Erro, e-mail inválido!");
    event.preventDefault();
    return false;
  }
  if (email.length < 11) {
    exibirErroEditar("Erro, e-mail precisa de no mínimo 11 caracteres!");
    event.preventDefault();
    return false;
  }

  if (senha.length > 0 || confirmarSenha.length > 0) {
    if (senha !== confirmarSenha) {
      exibirErroEditar("Erro, as senhas não coincidem!");
      event.preventDefault();
      return false;
    }
    if (senha === originalSenha) {
      exibirErroEditar("Erro, digite uma senha diferente da atual!");
      event.preventDefault();
      return false;
    }
    if (senha.length < 6) {
      exibirErroEditar("Erro, nova senha precisa de no mínimo 6 caracteres!");
      event.preventDefault();
      return false;
    }
  }

  if (nome === originalNome && email === originalEmail && senha.length === 0) {
    exibirErroEditar("Nenhuma alteração foi feita, clique no botão Cancelar");
    event.preventDefault();
    return false;
  }

  limparErroEditar();
  console.log(`Sucesso! Enviando dados para o usuário com ID: ${idParaEditar}`);
  // O formulário será enviado nativamente agora
  return true;
}

// ==========================================
// EVENTOS AO CARREGAR A PÁGINA (DOM)
// ==========================================
document.addEventListener("DOMContentLoaded", () => {
  // Botões de Cancelar (apenas limpam os erros)
  const btnCancelarCriar = document.querySelector("#modal-criar .btn-cancelar");
  if (btnCancelarCriar) {
    btnCancelarCriar.addEventListener("click", limparErroCriar);
  }

  const btnCancelarEditar = document.querySelector(
    "#modal-editar .btn-cancelar"
  );
  if (btnCancelarEditar) {
    btnCancelarEditar.addEventListener("click", () => {
      limparErroEditar();
      idParaEditar = null;
      originalNome = "";
      originalEmail = "";
      originalSenha = "";
    });
  }

  // Toggles de Senha (Visualização)
  const toggleCriarSenha = document.getElementById("toggle-criar-senha");
  const toggleCriarConfirmar = document.getElementById(
    "toggle-criar-confirmar"
  );
  const toggleEditarSenha = document.getElementById("toggle-editar-senha");
  const toggleEditarConfirmar = document.getElementById(
    "toggle-editar-confirmar"
  );
  const toggleViewSenha = document.getElementById("toggle-view-senha");

  if (toggleViewSenha) {
    toggleViewSenha.addEventListener("click", () => {
      const senhaSpan = document.getElementById("view-senha");
      if (senhaSpan.innerText === "******") {
        senhaSpan.innerText = senhaOriginalVisu;
        toggleViewSenha.classList.remove("bi-eye-fill");
        toggleViewSenha.classList.add("bi-eye-slash-fill");
      } else {
        senhaSpan.innerText = "******";
        toggleViewSenha.classList.remove("bi-eye-slash-fill");
        toggleViewSenha.classList.add("bi-eye-fill");
      }
    });
  }

  if (toggleCriarSenha) {
    toggleCriarSenha.addEventListener("click", () => {
      togglePasswordVisibility("criar-senha", toggleCriarSenha);
    });
  }

  if (toggleCriarConfirmar) {
    toggleCriarConfirmar.addEventListener("click", () => {
      togglePasswordVisibility("criar-confirmar-senha", toggleCriarConfirmar);
    });
  }

  if (toggleEditarSenha) {
    toggleEditarSenha.addEventListener("click", () => {
      togglePasswordVisibility("editar-senha", toggleEditarSenha);
    });
  }

  if (toggleEditarConfirmar) {
    toggleEditarConfirmar.addEventListener("click", () => {
      togglePasswordVisibility("editar-confirmar-senha", toggleEditarConfirmar);
    });
  }
});

// ==========================================
// FUNÇÕES DE ABERTURA DE MODAIS (Chamadas pelo HTML)
// ==========================================

function abrirModalVisualizar(id, nome, email, senha) {
  document.getElementById("view-id").innerText = id;
  document.getElementById("view-nome").innerText = nome;
  document.getElementById("view-email").innerText = email;
  senhaOriginalVisu = senha;

  const senhaSpan = document.getElementById("view-senha");
  const toggleIcon = document.getElementById("toggle-view-senha");

  if (senhaSpan) senhaSpan.innerText = "******";
  if (toggleIcon) {
    toggleIcon.classList.remove("bi-eye-slash-fill");
    toggleIcon.classList.add("bi-eye-fill");
  }
  abrirModal("modal-visualizar");
}

function abrirModalExcluir(id, nome) {
  idParaExcluir = id;
  // Garante que o input hidden existe antes de tentar setar o valor
  const inputDelete = document.getElementById("delete-id");
  if (inputDelete) inputDelete.value = id;

  document.getElementById("delete-modal-title").innerText = `Excluir ${nome}?`;
  document.getElementById(
    "delete-modal-text"
  ).innerText = `Tem certeza que deseja excluir usuário ${nome} (ID ${id})? Essa ação não pode ser desfeita!`;

  abrirModal("modal-delete");
}

function abrirModalEditar(id, nome, email, senha) {
  idParaEditar = id;
  originalNome = nome;
  originalEmail = email;
  originalSenha = senha;

  // Popula o formulário
  document.getElementById("editar-id").value = id;
  document.getElementById("editar-nome").value = nome;
  document.getElementById("editar-email").value = email;
  document.getElementById("editar-senha").value = senha; // Ou deixe vazio se preferir não mostrar a senha atual
  document.getElementById("editar-confirmar-senha").value = "";

  limparErroEditar();
  abrirModal("modal-editar");
}
