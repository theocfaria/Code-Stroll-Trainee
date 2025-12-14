<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post individual</title>
    <link rel="stylesheet" href="../../../public/css/styles_post_individual.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Shantell+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Shantell+Sans:ital,wght@0,300..800;1,300..800&family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <?php require __DIR__ . '/navbar.view.php'; ?>
    <div class="conteudo">
        <div class="hero_section">
            <div class="titulo_post">
                <h1><?= htmlspecialchars($posts[0]->title) ?></h1>
            </div>
            <div class="autor_datapub">
                <p><?= htmlspecialchars($postID[0]->name) ?></p>
                <p><?= date('d/m/Y', strtotime($posts[0]->created_at)) ?></p>
            </div>

            <div class="imagem">
                <?php if(!empty($posts[0]->image)): ?>
                    <img src="<?= htmlspecialchars($posts[0]->image) ?>" alt="Imagem do post" id="#imagem-principal">
                <?php endif; ?>
            </div>
        </div>

        <div class="descricao">
            <p>
                <?= nl2br(htmlspecialchars($posts[0]->content)) ?>
            </p>
        </div>
        <div class="mais_recentes">
            <div class="texto_maisrecentes">
                <p>Mais Recentes</p>
            </div>

            <?php if (!empty($recentPosts)): ?>
                <?php foreach ($recentPosts as $recent): ?>
                    
                    <a href="/post?id=<?= $recent->id ?>" class="card-link-wrapper">
                        <div class="cards">
                            <div class="imagem_card">
                                <?php 
                                    $imgSidebar = !empty($recent->image) ? $recent->image : '../../../public/assets/logo_code-removebg-preview.png'; 
                                ?>
                                <img src="<?= htmlspecialchars($imgSidebar) ?>" alt="Imagem card" id="second_imagem">
                            </div>

                            <div class="texto_card">
                                <div class="titulo_texto_card">
                                    <p><?= htmlspecialchars($recent->title) ?></p>
                                </div>
                                
                                <div class="juncao_texto autor_datapub_card">
                                    <p><?= htmlspecialchars($recent->autor_nome) ?></p>
                                    <p><?= date('d/m/Y', strtotime($recent->created_at)) ?></p>
                                </div>
                                
                                <div class="juncao_texto descricao_card">
                                    <p>
                                        <?= htmlspecialchars(substr($recent->content, 0, 80)) . (strlen($recent->content) > 80 ? '...' : '') ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>

                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align:center; padding: 20px;">Nenhum post recente.</p>
            <?php endif; ?>

        </div>
        <div class="voltar_posts">
            <a href="/lista-de-posts">
            <button class="botao">
                <i class="bi bi-arrow-left"></i>
                <div class="texto_botao">
                    <p>Voltar a lista de posts</p>
                </div>
            </button>
            </a>
        </div>
    </div>

<?php require __DIR__ . '/footer.view.php'; ?>
</body>

</html>