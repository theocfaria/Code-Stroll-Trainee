<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../../public/css/landingPage.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Shantell+Sans:ital,wght@0,300..800;1,300..800&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="../../../public/css/landingPage2.css"/>
  <title>Landing Page</title>
</head>

<body>
  <?php require __DIR__ . '/navbar.view.php'; ?>

  <main>

    <div class="introducao-lp">

      <div class="intro-esquerda">
        <p id="titulo-pagina">Conheça a página</p>
        <p id="texto-introducao">
          Este é o espaço digital da Code Stroll, dedicado a compartilhar insights
          e novidades do universo da tecnologia. Explore nossos artigos, análises e
          fique por dentro das últimas tendências tecnológicas do mercado.
        </p>
      </div>

      <div class="intro-direita">

        <a href="#secao-posts" class="bloco-pequeno">
          <span class="bloco-icone">📝</span>
          <div class="bloco-texto">
            <p class="bloco-titulo">Nossos últimos posts</p>
            <p class="bloco-descricao">Veja os artigos mais recentes e fique por dentro das novidades.</p>
          </div>
        </a>

        <div class="bloco-pequeno">
          <span class="bloco-icone">📱</span>
          <div class="bloco-texto">
            <p class="bloco-titulo">Em todos os dispositivos</p>
            <p class="bloco-descricao">Acompanhe nossa página de qualquer lugar.</p>
          </div>
        </div>

        <div class="bloco-pequeno">
          <span class="bloco-icone">🖥️</span>
          <div class="bloco-texto">
            <p class="bloco-titulo">Explore a tecnologia</p>
            <p class="bloco-descricao">Conheça mais sobre o vasto universo da computação.</p>
          </div>
        </div>

      </div>
    </div>

    <section class="posts-recentes" id="secao-posts">
      <p class="titulo-secao">Confira os posts mais recentes</p>
      <div class="carrossel">
        <div class="slider">
          <div class="nav-arrow arrow-left" id="seta-esquerda">&#10094</div>
          <div class="slider-conteudo">

            <article class="post-card">
              <div class="post-imagem-placeholder post-img1"></div>
              <p class="post-titulo">A Era da Nuvem</p>
              <p class="post-descricao">
                A computação em nuvem transformou o mercado global. Entenda como essa tecnologia escala infraestruturas
                e otimiza custos operacionais.
              </p>
              <span class="post-autor">Jane Joe, 1 dia atrás</span>
            </article>

            <article class="post-card">
              <div class="post-imagem-placeholder post-img2"></div>
              <p class="post-titulo">Avanços da I.A.</p>
              <p class="post-descricao">
                A Inteligência Artificial avança rapidamente. Veja como algoritmos e automação estão redefinindo o
                futuro do trabalho e da indústria.
              </p>
              <span class="post-autor">Carlos Eduardo, 1 dia atrás</span>
            </article>

            <article class="post-card">
              <div class="post-imagem-placeholder post-img3"></div>
              <p class="post-titulo">Código Limpo</p>
              <p class="post-descricao">
                Boas práticas de código são essenciais. Confira dicas vitais para desenvolvedores escreverem softwares
                limpos, escaláveis e eficientes.
              </p>
              <span class="post-autor">Maria Fernanda, 1 dia atrás</span>
            </article>

            <article class="post-card">
              <div class="post-imagem-placeholder post-img4"></div>
              <p class="post-titulo">Cibersegurança</p>
              <p class="post-descricao">
                A segurança da informação é prioridade máxima. Saiba como proteger dados corporativos contra ataques
                cibernéticos e vulnerabilidades.
              </p>
              <span class="post-autor">Marcelo Ferreira, 1 dia atrás</span>
            </article>

            <article class="post-card">
              <div class="post-imagem-placeholder post-img5"></div>
              <p class="post-titulo">Big Data</p>
              <p class="post-descricao">
                Dados são o novo petróleo. Descubra como a Ciência de Dados transforma números brutos em insights
                estratégicos para grandes decisões.
              </p>
              <span class="post-autor">Jane Joe, 2 dias atrás</span>
            </article>

            <article class="post-card">
              <div class="post-imagem-placeholder post-img6"></div>
              <p class="post-titulo">Frontend Moderno</p>
              <p class="post-descricao">
                O desenvolvimento web está em constante evolução. Conheça as novas frameworks e ferramentas que estão
                dominando o mercado neste ano.
              </p>
              <span class="post-autor">Carlos Eduardo, 2 dias atrás</span>
            </article>

            <article class="post-card">
              <div class="post-imagem-placeholder post-img7"></div>
              <p class="post-titulo">Mundo Conectado</p>
              <p class="post-descricao">
                A Internet das Coisas conecta o mundo físico ao digital. Veja como dispositivos inteligentes estão
                criando cidades mais eficientes.
              </p>
              <span class="post-autor">Marcelo Ferreira, 2 dias atrás</span>
            </article>

            <article class="post-card">
              <div class="post-imagem-placeholder post-img8"></div>
              <p class="post-titulo">Soft Skills</p>
              <p class="post-descricao">
                Além do código: as habilidades comportamentais. Saiba o que as grandes empresas de tecnologia buscam nos
                profissionais além da técnica.
              </p>
              <span class="post-autor">Maria Fernanda, 3 dias atrás</span>
            </article>
          </div>
          <div class="radio-auto"></div>
          <div class="nav-arrow arrow-right" id="seta-direita">&#10095</div>
        </div>
      </div> 
      <a href="lista-de-posts" class="bot-ver-todos">Ver todos os posts</a>

    </section>
  </main>
  <script src="/public/js/landing-page.js"></script>
  <?php require __DIR__ . '/footer.view.php'; ?>
</body>

</html>