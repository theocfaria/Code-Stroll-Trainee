function abrirModal(idModal) {
  document.getElementById("tela").style.display = "block";
  document.getElementById(idModal).style.display = "flex";
}

function fecharModal(idModal) {
  document.getElementById("tela").style.display = "none";
  document.getElementById(idModal).style.display = "none";
}

function definirDataAtual(idCampo) {
  const hoje = new Date();
  const campo = document.getElementById(idCampo);
}

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

let idParaExcluir = null;
let idParaEditar = null;
let originalNome = "";
let originalEmail = "";
let originalSenha = "";
let senhaOriginalVisu = "";

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

document.addEventListener("DOMContentLoaded", () => {
  const btnSubmitCriar = document.getElementById("btn-submit-criar");
  const inputNomeCriar = document.getElementById("criar-nome");
  const inputEmailCriar = document.getElementById("criar-email");
  const inputSenhaCriar = document.getElementById("criar-senha");
  const inputConfirmarSenhaCriar = document.getElementById(
    "criar-confirmar-senha"
  );

  if (btnSubmitCriar) {
    btnSubmitCriar.addEventListener("click", () => {
      const nome = inputNomeCriar.value;
      const email = inputEmailCriar.value;
      const senha = inputSenhaCriar.value;
      const confirmarSenha = inputConfirmarSenhaCriar.value;

      if (!nome || !email || !senha || !confirmarSenha) {
        exibirErroCriar("Todos os campos são obrigatórios!");
        return;
      }
      if (nome.length < 3) {
        exibirErroCriar("Erro, nome precisa de no mínimo 3 caracteres!");
        return;
      }
      if (!email.includes("@") || !email.includes(".com")) {
        exibirErroCriar("Erro, e-mail inválido!");
        return;
      }
      if (email.length < 11) {
        exibirErroCriar("Erro, e-mail precisa de no mínimo 11 caracteres!");
        return;
      }
      if (senha.length < 6) {
        exibirErroCriar("Erro, senha precisa de no mínimo 6 caracteres!");
        return;
      }

      const specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;
      const numberRegex = /\d/;
      const letterRegex = /[a-zA-Z]/;

      if (!specialCharRegex.test(senha)) {
        exibirErroCriar(
          "Erro, senha precisa de ao menos um caracter especial!"
        );
        return;
      }
      if (!numberRegex.test(senha)) {
        exibirErroCriar("Erro, senha precisa de ao menos um número!");
        return;
      }
      if (!letterRegex.test(senha)) {
        exibirErroCriar("Erro, senha precisa de ao menos uma letra!");
        return;
      }

      if (senha !== confirmarSenha) {
        exibirErroCriar("Erro, as senhas não coincidem!");
        return;
      }

      limparErroCriar();

      inputNomeCriar.value = "";
      inputEmailCriar.value = "";
      inputSenhaCriar.value = "";
      inputConfirmarSenhaCriar.value = "";

      console.log("Sucesso! Fechando modal.");
      fecharModal("modal-criar");
    });
  }
  const btnCancelarCriar = document.querySelector("#modal-criar .btn-cancelar");
  if (btnCancelarCriar) {
    btnCancelarCriar.addEventListener("click", limparErroCriar);
  }

  const btnSubmitEditar = document.getElementById("btn-submit-editar");
  if (btnSubmitEditar) {
    btnSubmitEditar.addEventListener("click", () => {
      const inputNome = document.getElementById("editar-nome");
      const inputEmail = document.getElementById("editar-email");
      const inputSenha = document.getElementById("editar-senha");
      const inputConfirmarSenha = document.getElementById(
        "editar-confirmar-senha"
      );

      const nome = inputNome.value;
      const email = inputEmail.value;
      const senha = inputSenha.value;
      const confirmarSenha = inputConfirmarSenha.value;

      if (!nome || !email) {
        exibirErroEditar("Nome e E-mail são obrigatórios!");
        return;
      }
      if (nome.length < 3) {
        exibirErroEditar("Erro, nome precisa de no mínimo 3 caracteres!");
        return;
      }
      if (!email.includes("@") || !email.includes(".com")) {
        exibirErroEditar("Erro, e-mail inválido!");
        return;
      }
      if (email.length < 11) {
        exibirErroEditar("Erro, e-mail precisa de no mínimo 11 caracteres!");
        return;
      }

      if (senha.length > 0 || confirmarSenha.length > 0) {
        if (senha !== confirmarSenha) {
          exibirErroEditar("Erro, as senhas não coincidem!");
          return;
        }
        if (senha === originalSenha) {
          exibirErroEditar("Erro, digite uma senha diferente da atual!");
          return;
        }
        if (senha.length < 6) {
          exibirErroEditar(
            "Erro, nova senha precisa de no mínimo 6 caracteres!"
          );
          return;
        }

        const specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;
        const numberRegex = /\d/;
        const letterRegex = /[a-zA-Z]/;

        if (!specialCharRegex.test(senha)) {
          exibirErroEditar(
            "Erro, nova senha precisa de ao menos um caracter especial!"
          );
          return;
        }
        if (!numberRegex.test(senha)) {
          exibirErroEditar("Erro, nova senha precisa de ao menos um número!");
          return;
        }
        if (!letterRegex.test(senha)) {
          exibirErroEditar("Erro, nova senha precisa de ao menos uma letra!");
          return;
        }
      }

      if (
        nome === originalNome &&
        email === originalEmail &&
        senha.length === 0
      ) {
        exibirErroEditar(
          "Nenhuma alteração foi feita, clique no botão Cancelar"
        );
        return;
      }

      limparErroEditar();

      console.log(
        `Sucesso! Salvando dados para o usuário com ID: ${idParaEditar}`
      );
      idParaEditar = null;
      originalNome = "";
      originalEmail = "";
      originalSenha = "";
      fecharModal("modal-editar");
    });
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

  const btnSubmitExcluir = document.getElementById("btn-submit-excluir");
  if (btnSubmitExcluir) {
    btnSubmitExcluir.addEventListener("click", () => {
      console.log(`Excluindo usuário com ID: ${idParaExcluir}`);

      fecharModal("modal-delete");
      idParaExcluir = null;
    });
  }

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

  document.getElementById("editar-nome").value = nome;
  document.getElementById("editar-email").value = email;
  document.getElementById("editar-senha").value = "";
  document.getElementById("editar-confirmar-senha").value = "";

  limparErroEditar();
  abrirModal("modal-editar");
}
