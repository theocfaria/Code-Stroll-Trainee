<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Lista de Posts</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/css/lista_de_posts.css" />
</head>

<body>
    <?php require __DIR__ . '/navbar.view.php'; ?>
    <div class="conteudo">
        <h1>Principais Postagens</h1>

        <div class="posts">
            <?php if (empty($posts)): ?>
                <p>Nenhum post encontrado.</p>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <a href="post?id=<?= $post->id ?>">
                        <div class="post">
                            <img class="imagem" src="<?= $post->image ?>" alt="Imagem do post">

                            <div class="info">
                                <p class="titulo_post"><strong><?= $post->title  ?></strong></p>
                                <p class="autor"><?= $post->autor_nome ?></p>
                                <p class="publicacao">Publicado em <?= $post->created_at ?></p>
                            </div>

                            <p class="resumo"><?= $post->content ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="paginacao">
            <?php if ($page >= 2): ?>
                <a href="?pagina=<?= $page - 1 ?>" class="passa_pag">
                    <i class="material-icons">arrow_back</i>
                    <p>Anterior</p>
                </a>
            <?php endif; ?>

            <?php if ($page > 1): ?>
                <a href="?pagina=<?= 1 ?>">
                    1
                </a>
            <?php endif; ?>

            <?php for ($i = $page; $i < $page + 3 && $i <= $total; $i++): ?>
                <a href="?pagina=<?= $i ?>" class="<?= $i == $page ? 'atual' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($page + 3 < $total): ?>
                <a href="#">...</a>
            <?php endif; ?>

            <!-- Última página -->
            <?php if ($page + 3 < $total): ?>
                <a href="?pagina=<?= $total ?>">
                    <?= $total ?>
                </a>
            <?php endif; ?>




            <!-- Campo para digitar uma página específica     (FAZER MODAL DEPOIS)
            <form method="GET" action="" class="form-paginacao">
                <input type="number" name="pagina" min="1" max="" placeholder="Ir para..." required>
                <button type="submit">Ir</button>
            </form>-->

            <!-- Botão para a próxima página -->
            <?php if ($page < $total): ?>
                <a href="?pagina=<?= $page + 1 ?>" class="passa_pag">
                    <p>Próximo</p> <i class="material-icons">arrow_forward</i>
                </a>
            <?php endif; ?>
        </div>

    </div>
    <?php require __DIR__ . '/footer.view.php'; ?>
</body>

</html>