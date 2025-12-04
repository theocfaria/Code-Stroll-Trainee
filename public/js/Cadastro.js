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

function alternaOlhoConfirma() {
  const inputConfirma = document.getElementById("confirmaSenha");
  const icone = document.getElementById("olhoIconConfirma");

  if (inputConfirma.type === "password") {
    inputConfirma.type = "text";
    icone.classList.remove("bi-eye-slash");
    icone.classList.add("bi-eye");
  } else {
    inputConfirma.type = "password";
    icone.classList.remove("bi-eye");
    icone.classList.add("bi-eye-slash");
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const btnEntrar = document.getElementById("entrar");
  const inputNome = document.getElementById("nome");
  const inputEmail = document.getElementById("email");
  const inputSenha = document.getElementById("senha");
  const inputConfirmaSenha = document.getElementById("confirmaSenha");

  if (btnEntrar) {
    btnEntrar.addEventListener("click", (e) => {
      const nome = inputNome.value.trim();
      const email = inputEmail.value.trim();
      const senha = inputSenha.value;
      const confirmaSenha = inputConfirmaSenha.value;

      if (!nome || !email || !senha || !confirmaSenha) {
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

      if (senha !== confirmaSenha) {
        alert("Erro: As senhas não coincidem!");
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