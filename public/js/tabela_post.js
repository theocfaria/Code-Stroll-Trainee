const tela = document.getElementById("tela");
let originalImagem,
  originalTitulo,
  originalDescricao,
  originalAutor,
  originalData;

function abrirModal(idModal) {
  if (idModal === "modal-criar") {
    definirDataAtual("criar-data");
  }
  const m = document.getElementById(idModal);
  if (!m) return;
  m.style.display = "flex";
  tela.style.display = "block";
}

function fecharModal(idModal) {
  const m = document.getElementById(idModal);
  if (!m) return;
  m.style.display = "none";
  tela.style.display = "none";

  const erro = m.querySelector(".modal-erro");
  if (erro) {
    erro.innerText = "";
    erro.style.display = "none";
  }
}

function exibirErro(idErro, texto) {
  const el = document.getElementById(idErro);
  if (!el) return;
  el.innerText = texto;
  el.style.display = "block";
}

function limparErro(idErro) {
  const el = document.getElementById(idErro);
  if (!el) return;
  el.innerText = "";
  el.style.display = "none";
}

function mostrarMensagem(texto, tipo = "sucesso") {
  const msg = document.createElement("div");
  msg.textContent = texto;
  msg.className = tipo === "erro" ? "mensagem-erro" : "mensagem-sucesso";
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
  const mm = String(hoje.getMonth() + 1).padStart(2, "0");
  const dd = String(hoje.getDate()).padStart(2, "0");

  campoData.value = `${yyyy}-${mm}-${dd}`;
}

function abrirModalVisualizar(id, titulo, autor, data, imagemUrl, descricao) {
  document.getElementById("view-id").textContent = id;
  document.getElementById("view-titulo").textContent = titulo;
  document.getElementById("view-autor").textContent = autor;
  document.getElementById("view-data").textContent = data;
  document.getElementById("view-descricao").textContent = descricao;

  document.getElementById("view-imagem").src =
    imagemUrl && imagemUrl !== "" ? imagemUrl : "public/assets/default.png";

  abrirModal("modal-visualizar");
}

function abrirModalEditar(id, titulo, autor, data, imagem, descricao) {
  originalImagem = imagem;
  originalTitulo = titulo;
  originalDescricao = descricao;
  originalAutor = autor;
  originalData = data;

  document.getElementById("editar-id").value = id;
  document.getElementById("editar-titulo").value = titulo;
  document.getElementById("editar-autor").value = autor;
  document.getElementById("editar-data").value = data;
  document.getElementById("editar-descricao").value = descricao;

  document.getElementById("preview-imagem").src = imagem;

  document.getElementById("editar-imagem-atual").value = imagem;

  document.getElementById("editar-imagem-nova").value = "";

  const textoEditar = document.getElementById("nome-arquivo-editar");
  if (textoEditar) {
    textoEditar.textContent = "Manter imagem atual";
    textoEditar.style.fontWeight = "normal";
    textoEditar.style.color = "#555";
  }

  abrirModal("modal-editar");
}

function abrirModalEditarComData(btn) {
  abrirModalEditar(
    btn.dataset.id,
    btn.dataset.title,
    btn.dataset.author,
    btn.dataset.date,
    btn.dataset.image,
    btn.dataset.content
  );
}

function abrirModalExcluir(id, titulo) {
  const modal = document.getElementById("modal-delete");
  if (!modal) return;

  document.getElementById("delete-id").value = id;

  const texto = document.getElementById("delete-modal-text");
  if (texto) {
    texto.textContent = `Tem certeza que deseja excluir o post de ID ${id}: "${titulo}"?`;
  }

  abrirModal("modal-delete");
}

function validarFormulario(camposIds, idErro) {
  for (const idCampo of camposIds) {
    const campo = document.getElementById(idCampo);
    if (!campo || !campo.value || campo.value.trim() === "") {
      exibirErro(idErro, "Preencha todos os campos antes de confirmar.");
      return false;
    }
  }
  limparErro(idErro);
  return true;
}

document.addEventListener("DOMContentLoaded", () => {
  const btnConfirmarCriar = document.getElementById("btn-submit-criar");
  if (btnConfirmarCriar) {
    btnConfirmarCriar.addEventListener("click", () => {
      const camposParaValidar = [
        "criar-imagem",
        "criar-titulo",
        "criar-descricao",
        "criar-autor",
        "criar-data",
      ];

      if (validarFormulario(camposParaValidar, "modal-criar-erro")) {
        console.log("Formulário de CRIAR é válido. Enviando...");
        fecharModal("modal-criar");
        mostrarMensagem("Post criado com sucesso!");
      } else {
        console.log("Formulário de CRIAR inválido.");
      }
    });
  }

  const btnConfirmarEditar = document.getElementById("btn-submit-editar");
  if (btnConfirmarEditar) {
    btnConfirmarEditar.addEventListener("click", () => {
      const id = document.getElementById("editar-id").value;
      const imagemAtual = document.getElementById("editar-imagem").value;
      const tituloAtual = document.getElementById("editar-titulo").value;
      const descricaoAtual = document.getElementById("editar-descricao").value;
      const autorAtual = document.getElementById("editar-autor").value;
      const dataAtual = document.getElementById("editar-data").value;

      if (
        imagemAtual === originalImagem &&
        tituloAtual === originalTitulo &&
        descricaoAtual === originalDescricao &&
        autorAtual === originalAutor &&
        dataAtual === originalData
      ) {
        exibirErro(
          "modal-editar-erro",
          "Nenhuma alteração foi feita, clique no botão Cancelar"
        );
        return;
      }

      const camposParaValidar = [
        "editar-imagem",
        "editar-titulo",
        "editar-descricao",
        "editar-autor",
        "editar-data",
      ];

      if (validarFormulario(camposParaValidar, "modal-editar-erro")) {
        console.log(
          `Formulário de EDITAR é válido. Enviando dados para o ID: ${id}`
        );
        fecharModal("modal-editar");
        mostrarMensagem("Post editado com sucesso!");
      } else {
        console.log("Formulário de EDITAR inválido.");
      }
    });
  }

  const btnConfirmarExcluir = document.getElementById("btn-submit-excluir");
  if (btnConfirmarExcluir) {
    btnConfirmarExcluir.addEventListener("click", () => {
      const modal = document.getElementById("modal-delete");
      const id = modal.dataset.id;
      console.log(`Enviando solicitação para EXCLUIR o ID: ${id}`);
      fecharModal("modal-delete");
    });
  }

  if (tela) {
    tela.addEventListener("click", () => {
      [
        "modal-criar",
        "modal-editar",
        "modal-visualizar",
        "modal-delete",
      ].forEach((id) => {
        const m = document.getElementById(id);
        if (m && m.style.display === "flex") {
          fecharModal(id);
        }
      });
    });
  }
});

const inputImagem = document.getElementById("criar-imagem");
const textoArquivo = document.getElementById("nome-arquivo-texto");

if (inputImagem && textoArquivo) {
  inputImagem.addEventListener("change", function () {
    if (this.files && this.files.length > 0) {
      textoArquivo.textContent = this.files[0].name;
      textoArquivo.style.fontWeight = "bold";
    } else {
      textoArquivo.textContent = "Nenhum arquivo selecionado";
      textoArquivo.style.fontWeight = "normal";
    }
  });
}

const inputEditar = document.getElementById("editar-imagem-nova");
const textoEditar = document.getElementById("nome-arquivo-editar");

if (inputEditar && textoEditar) {
  inputEditar.addEventListener("change", function () {
    if (this.files && this.files.length > 0) {
      textoEditar.textContent = this.files[0].name;
      textoEditar.style.color = "#000";
      textoEditar.style.fontWeight = "bold";
    } else {
      textoEditar.textContent = "Manter imagem atual";
      textoEditar.style.color = "#555";
      textoEditar.style.fontWeight = "normal";
    }
  });
}
