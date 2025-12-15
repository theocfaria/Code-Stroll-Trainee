<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../../public/css/navbar.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar</title>
</head>

<body>
  <div id="botoes-telefone">
    <div class="links-telefone">
      <a href="/" id="home"><p class="navegacao-navbar">Home</p></a>
      <a href="sobre-nos" id="sobre-nos"><p class="navegacao-navbar">Sobre nós</p></a>
      <a href="lista-de-posts" id="publicacoes"><p class="navegacao-navbar">Publicações</p></a>
      <a href="login" id="login"><p class="navegacao-navbar">Login</p></a>
    </div>
    <i class="bi bi-x" id="icon" onclick="fechaMenu('botoes-telefone', 'barra')"></i>
  </div>

  <div id="barra">
    <div class="logotipo">
      <a href="/">
        <img src="../../../public/assets/Logo.png" alt="Logotipo">
        <img src="../../../public/assets/logotipo.png" alt="Logotipo 2">
      </a>
    </div>

    <form action="/lista-de-posts" method="GET" class="botao_pesquisa">
      <div class="search">
        <input type="text" name="busca" value="<?= htmlspecialchars($busca ?? '') ?>" id="barra-pesquisa" placeholder="Pesquisar post">
        <button type="submit" class="btn-pesquisa">
          <i class="bi-search"></i>
        </button>
      </div>
    </form>

    <i class="bi bi-list" id="hamburguericon" onclick="abrirMenu('botoes-telefone', 'barra')"></i>
    <div id="link">
      <a href="/" id="home"><p class="navegacao-navbar">Home</p></a>
      <a href="sobre-nos" id="sobre-nos"><p class="navegacao-navbar">Sobre nós</p></a>
      <a href="lista-de-posts" id="publicacoes"><p class="navegacao-navbar">Publicações</p></a>
      <a href="login" id="login"><p class="navegacao-navbar">Login</p></a>
    </div>
  </div>
  <script src="../../../public/js/script.js"></script>
</body>

</html>