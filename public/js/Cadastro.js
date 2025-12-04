function alternaOlho() {
  const inputSenha = document.getElementById("senha");
  const icone = document.getElementById("olhoIcon");

  if (inputSenha.type === "password") {
    inputSenha.type = "text";
    icone.classList.remove("bi-eye-slash");
    icone.classList.add("bi-eye");
  } else {
    inputSenha.type = "password";
    icone.classList.remove("bi-eye");
    icone.classList.add("bi-eye-slash");
  }
}

function definirDataAtual() {
  const campoData = document.getElementById("data");

  if (campoData) {
    const hoje = new Date();
    const ano = hoje.getFullYear();
    const mes = String(hoje.getMonth() + 1).padStart(2, "0");
    const dia = String(hoje.getDate()).padStart(2, "0");
    const dataFormatada = `${ano}-${mes}-${dia}`;
    campoData.value = dataFormatada;
  }
}

document.addEventListener("DOMContentLoaded", () => {
  definirDataAtual();
  const btnEntrar = document.getElementById("entrar");
  const inputNome = document.getElementById("nome");
  const inputSobrenome = document.getElementById("sobrenome");
  const inputEmail = document.getElementById("email");
  const inputSenha = document.getElementById("senha");
  const inputData = document.getElementById("data");

  if (btnEntrar) {
    btnEntrar.addEventListener("click", (e) => {
      const nome = inputNome.value.trim();
      const sobrenome = inputSobrenome.value.trim();
      const email = inputEmail.value.trim();
      const senha = inputSenha.value;
      const data = inputData.value;
      if (!nome || !sobrenome || !email || !senha || !data) {
        alert("Todos os campos são obrigatórios!");
        return;
      }

      if (nome.length < 3) {
        alert("Erro: O nome precisa ter no mínimo 3 caracteres!");
        return;
      }

      if (!email.includes("@") || !email.includes(".")) {
        alert("Erro: E-mail inválido!");
        return;
      }

      if (senha.length < 6) {
        alert("Erro: A senha precisa ter no mínimo 6 caracteres!");
        return;
      }

      const specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;
      const numberRegex = /\d/;
      const letterRegex = /[a-zA-Z]/;

      if (!specialCharRegex.test(senha)) {
        alert("Erro: A senha precisa de ao menos um caractere especial!");
        return;
      }
      if (!numberRegex.test(senha)) {
        alert("Erro: A senha precisa de ao menos um número!");
        return;
      }
      if (!letterRegex.test(senha)) {
        alert("Erro: A senha precisa de ao menos uma letra!");
        return;
      }

      console.log("Cadastro Validado!");
      alert("Cadastro realizado com sucesso! (Simulação)");
    });
  }
});
