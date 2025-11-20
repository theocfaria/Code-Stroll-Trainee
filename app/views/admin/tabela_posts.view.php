<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap"
        rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../public/css/styles_tabela_posts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div id="tela"></div>

    <div class="navbar">
        <p id="texto_post">TABELA DE POSTS</p>
        <button id="criar" onclick="abrirModal('modal-criar')"><i class="bi bi-plus-lg"></i></button>
    </div>

    <div class="conteudo">
        <div class="barra_pesquisa">
            <button id="pesquisa">
                <p>PESQUISAR</p>
                <i class="bi bi-search"></i>
            </button>
        </div>
        <div class="tabela">
            <table>
                <thead>
                    <tr>
                        <th id="teste1">ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Data de criação</th>
                        <th id="teste2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($posts as $post): ?>
                    <tr>
                        <td class="teste3 teste4"><?= $post->id ?></td>
                        <td class="teste4"><?= $post->title ?></td>
                        <td class="teste4"><?= $post->author ?></td>
                        <td class="teste4"><?= $post->created_at ?></td>
                        <td class="acoes">
                            <button type="button" class="btn-primary"
                                onclick="abrirModalVisualizar('<?= $post->id ?>')">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button type="button" class="btn-primary"
                                onclick="abrirModalEditar('<?= $post->id ?>')">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button type="button" class="btn-primary" onclick="abrirModalExcluir('<?= $post->id ?>', <?= $post->id ?>)" >
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <div class="foot">
                <button class="botao_foot1"><i class="bi bi-arrow-left-circle"></i></button>
                <button class="botao_foot pagina-ativa">1</button>
                <button class="botao_foot">2</button>
                <button class="botao_foot">3</button>
                <button class="botao_foot">4</button>
                <button class="botao_foot1"><i class="bi bi-arrow-right-circle"></i></button>
            </div>
        </div>
    </div>

    <?php foreach($posts as $post): ?>
        <div id="modal-delete">
            <h3 id="delete-modal-title">Excluir Post</h3>
            <p id="delete-modal-text">Tem certeza que deseja excluir este post?</p><strong> <?= $post->id ?> </strong>
                <div class="modal-buttons">
                    <form action="/crudPosts/delete" method="POST">
                        <input type="hidden" value= <?= $post->id ?> name="id">
                        <button type="button" id="btn-submit-excluir" class="btn-excluir">Excluir</button>
                        <button type="button" class="btn-cancelar" onclick="fecharModal('modal-delete')">Cancelar</button>
                    </form>
                </div>
        </div>

        <div id="modal-visualizar" <?= $post->id ?>>
            <h3 id="visualizar-titulo">Detalhes do Post</h3>
            <p><strong>ID:</strong> <?= $post->id ?> <span id="view-id"></span></p>
            
            <p><strong>Imagem:</strong> <?= $post->image ?></p>
        <img id="view-imagem" src="" alt="Imagem do Post" style="max-width: 100%; border-radius: 10px; margin-bottom: 10px; min-height: 200px; background-color: #f0f0f0;">
            
            <p><strong>Título:</strong> <?= $post->title ?> <span id="view-titulo"></span></p>
            
            <p><strong>Descrição:</strong> <?= $post->content ?> <span id="view-descricao" style="word-break: break-word;"></span></p>
            
            <p><strong>Autor:</strong> <?= $post->author ?> <span id="view-autor"></span></p>
            <p><strong>Data:</strong> <?= $post->created_at ?> <span id="view-data"></span></p>
            
            <button id="sair" onclick="fecharModal('modal-visualizar')">Fechar</button>
        </div>

        <div id="modal-editar">
            <h3>Editar Post</h3>
            <form class="modal-form">
                <input type="hidden" id="editar-id">
                
                <div class="form-group">
                    <label for="editar-imagem">URL da Imagem:</label>
                    <input type="text" id="editar-imagem" required />
                </div>
                <div class="form-group">
                    <label for="editar-titulo">Título:</label>
                    <input type="text" id="editar-titulo" required />
                </div>

                <div class="form-group">
                    <label for="editar-descricao">Descrição:</label>
                    <textarea id="editar-descricao" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="editar-autor">Autor:</label>
                    <input type="text" id="editar-autor" required />
                </div>
                <div class="form-group">
                    <label for="editar-data">Data:</label>
                    <input type="date" id="editar-data" required />
                </div>
            </form>
            <p id="modal-editar-erro" class="modal-erro"></p>
            <div class="modal-buttons">
                <button type="button" id="btn-submit-editar" class="btn-salvar">Salvar</button>
                <button type="button" class="btn-cancelar" onclick="fecharModal('modal-editar')">Cancelar</button>
            </div>
        </div>
    <?php endforeach ?>

    <div id="modal-criar">
        <h3>Criar Novo Post</h3>
        <form class="modal-form" method="POST" action="/crudPosts/create">
            <div class="form-group">
                <label for="criar-titulo">Título:</label>
                <input type="text" id="criar-titulo" name="title" required />
            </div>

            <div class="form-group">
                <label for="criar-descricao">Descrição:</label>
                <textarea id="criar-descricao" rows="4" name="content" required></textarea>
            </div>

            <div class="form-group">
                <label for="criar-autor">Autor:</label>
                <input type="text" id="criar-autor" name="author" value="1" required />
            </div>

            <div class="form-group">
                <label for="criar-data">Data:</label>
                <input type="date" id="criar-data" name="created_at" required readonly />
            </div>
            <div class="form-group">
                <label for="criar-imagem">Imagem:</label>
                <input type="file" id="criar-imagem" accept = "image/*" name="image" required />
            </div>
                <div class="modal-buttons">
                <button type="submit" id="btn-submit-criar" class="btn-salvar">Criar</button>
                <button type="button" class="btn-cancelar" onclick="fecharModal('modal-criar')">Cancelar</button>
            </div>
        </form>
        <p id="modal-criar-erro" class="modal-erro"></p>
    </div>
</body>

<script src="../../../public/js/tabela_post.js"></script>

</html>