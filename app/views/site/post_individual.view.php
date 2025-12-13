<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post individual</title>
    <link rel="stylesheet" href="../../../public/css/styles_post_individual.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Shantell+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Shantell+Sans:ital,wght@0,300..800;1,300..800&family=Silkscreen:wght@400;700&display=swap"
        rel="stylesheet">
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
                <p><?= $postID[0]->name ?></p>
                <p><?= $posts[0]->created_at ?></p>
            </div>


            <div class="imagem">
                <img src="<?= $posts[0]->image ?>" alt="Imagem do post" id="#imagem-principal">
            </div>
        </div>

        <div class="descricao">
            <p>
                <?= $posts[0]->content ?>
            </p>
        </div>
        <div class="mais_recentes">
            <div class="texto_maisrecentes">
                <p>Mais Recentes</p>
            </div>
            <div class="cards">
                <div class="imagem_card">
                    <img src="../../../public/assets/logo_code-removebg-preview.png" alt="" id="second_imagem">
                </div>
                <div class="texto_card">
                    <div class="titulo_texto_card">
                        <p>Lorem Ipsum</p>
                    </div>
                    <div class="juncao_texto autor_datapub_card">
                        <p>Autor</p>
                        <p>Data de Publicação</p>
                    </div>
                    <div class="juncao_texto descricao_card">
                        <p>Lorem Ipsum Lorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem
                            IpsumLorem IpsumLorem IpsumLorem IpsumLorem Ipsum
                        </p>
                    </div>
                </div>
            </div>
            <div class="cards">
                <div class="imagem_card">
                    <img src="../../../public/assets/logo_code-removebg-preview.png" alt="" id="second_imagem">
                </div>
                <div class="texto_card">
                    <div class="titulo_texto_card">
                        <p>Lorem Ipsum</p>
                    </div>
                    
                    <div class="juncao_texto autor_datapub_card">
                        <p>Autor</p>
                        <p>Data de Publicação</p>
                    </div>
                    <div class="juncao_texto descricao_card">
                        <p>Lorem Ipsum Lorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem
                            IpsumLorem IpsumLorem IpsumLorem IpsumLorem Ipsum
                        </p>
                    </div>
                </div>
            </div>
            <div class="cards">
                <div class="imagem_card">
                    <img src="../../../public/assets/logo_code-removebg-preview.png" alt="" id="second_imagem">
                </div>
                <div class="texto_card">
                    <div class="titulo_texto_card">
                        <p>Lorem Ipsum</p>
                    </div>
                    <div class="juncao_texto autor_datapub_card">
                        <p>Autor</p>
                        <p>Data de Publicação</p>
                    </div>
                    <div class="juncao_texto descricao_card">
                        <p>Lorem Ipsum Lorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem
                            IpsumLorem IpsumLorem IpsumLorem IpsumLorem Ipsum
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="voltar_posts">
            <button class="botao">
                <i class="bi bi-arrow-left"></i>
                <div class="texto_botao">
                    Voltar a lista de posts
                </div>
            </button>
        </div>
    </div>

<?php require __DIR__ . '/footer.view.php'; ?>
</body>

</html>