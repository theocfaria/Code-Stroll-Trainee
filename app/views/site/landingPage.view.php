<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/public/css/landingPage.css" />
  <link rel="stylesheet" href="/public/css/landingPage2.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Shantell+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet" />
  <link rel="icon" href="../../../public/assets/logoD.png" type="image/png">
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
            <p class="bloco-descricao">Veja os posts mais recentes e fique por dentro das novidades.</p>
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
            
            <?php if (!empty($posts)): ?>
              <?php foreach ($posts as $post): ?>
                
                <a href="/post?id=<?= $post->id ?>" class="post-link-wrapper">
                  
                  <article class="post-card">
                    <?php 
                      $imgUrl = (isset($post->image) && !empty($post->image)) ? $post->image : ''; 
                      
                      $inlineStyle = $imgUrl ? "background-image: url('{$imgUrl}');" : "";
                      
                      $classPlaceholder = $imgUrl ? 'post-imagem-placeholder' : 'post-imagem-placeholder post-img1';
                    ?>

                    <div class="<?= $classPlaceholder ?>" style="<?= $inlineStyle ?>"></div>

                    <p class="post-titulo"><?= htmlspecialchars($post->title) ?></p>
                    
                    <p class="post-descricao">
                      <?= htmlspecialchars(substr($post->content, 0, 120)) . (strlen($post->content) > 120 ? '...' : '') ?>
                    </p>
                    
                    <span class="post-autor">
                      <?= htmlspecialchars($post->autor_nome) ?>, 
                      <?= date('d/m/Y', strtotime($post->created_at)) ?>
                    </span>
                  </article>
                </a>

              <?php endforeach; ?>
            <?php else: ?>
               <p style="color:white; padding: 20px;">Nenhum post encontrado.</p>
            <?php endif; ?>

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