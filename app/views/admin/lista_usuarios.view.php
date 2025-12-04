<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap"
      rel="stylesheet"
    />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../../../public/css/lista_usuarios.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    />
  </head>

  <body>
    <div id="tela"></div>
    <div class="navbar">
      <p id="texto_post">PÁGINA DE USUÁRIOS</p>
      <button id="criar" onclick="abrirModal('modal-criar')">
        <i class="bi bi-plus-lg"></i>
      </button>
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
              <th>Nome</th>
              <th>Email</th>
              <th id="teste2">Ações</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td class="teste3 teste4"><?= $user->id ?></td>
                <td class="teste4"><?= $user->name ?></td>
                <td class="teste4"><?= $user->email ?></td>
                <td class="acoes">
                    <button type="button" class="btn-primary"
                        onclick="abrirModalVisualizar('<?= $user->id ?>', '<?= $user->name ?>', '<?= $user->email ?>', '<?= $user->password ?>')">
                        <i class="bi bi-eye"></i>
                    </button>
                    <button type="submit" class="btn-primary"
                        data-id="<?= $user->id ?>"
                        data-name="<?= $user->name ?>"
                        data-email="<?= $user->email ?>"
                        data-password="<?= $user->password ?>"
                        onclick="abrirModalEditar('<?= $user->id ?>', '<?= $user->name ?>', '<?= $user->email ?>', '<?= $user->password ?>')"
                        >
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button type="button" class="btn-primary" onclick="abrirModalExcluir('<?= $user->id ?>', '<?= $user->name ?>')" >
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
            <?php endforeach; ?> 
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

       <!--- <nav aria-label="Page navigation example">
            <ul class="pagination">
                </?php $tempSearch = isset($busca) && $busca !== '' ? '&busca='. urlencode($busca) : ""; ?>


                <li class="page-item setas</?= $page == 1 ?'disabled' : '' ?>" id="setas">
                    <a class="page-link" href="?pagina=</?= max(1,$page-1) ?></?= $tempSearch ?> "><i class="bi bi-arrow-left-circle"></i></a>
                </li>

                <li class="page-item </?= $page == 1 ?'active' : '' ?>">
                    <a class="page-link" href="?pagina=</?= 1 ?></?= $tempSearch ?>">1</a>
                </li>

                </*?php 
                    $maxBotoes = 5;

                    $inicio = max(1, $page - (int)floor($maxBotoes/2));

                    $fim = min($total, $inicio + $maxBotoes - 1);

                    if($fim - $inicio + 1 < $maxBotoes)
                    {
                        $inicio = max(1, $fim-$maxBotoes+1);
                    }

                ?>

                </*?php for($i = $inicio + 1; $i <= $fim-1; $i++): ?>

                    <li class="page-item pagina-ativa</*?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?pagina=</*?= $i ?>"></*?= $i ?></*?= $tempSearch ?></a>
                    </li>

                </?php endfor; ?>

                <li class="page-item </*?= $page == $total ?'active' : '' ?>">
                    <a class="page-link" href="?pagina=</*?= $total ?></*?= $tempSearch ?>"></*?= $total ?></a>
                </li>

                <li class="page-item setas</*?= $page == $total ?'disabled' : '' ?>" id="setas">
                    <a class="page-link" href="?pagina=</*?= min($total, $page + 1) ?></*?= $tempSearch ?>"><i class="bi bi-arrow-right-circle"></i></a>
                </li>
            </ul>
        </nav>-->
      </div>
    </div>
    
    <?php foreach ($users as $user): ?>
    <div id="modal-delete">
      <h3 id="delete-modal-title">Excluir Usuário</h3>
      <p id="delete-modal-text">Tem certeza que deseja excluir este usuário?</p>

      <div class="modal-buttons">
        <form action="/crudUsers/delete" method="POST">
          <input type="hidden" name="id" id="delete-id"> 
          <button type="submit" id="btn-submit-excluir" class="btn-excluir">
            Excluir
          </button>
          <button
            type="button"
            class="btn-cancelar"
            onclick="fecharModal('modal-delete')"
          >
            Cancelar
          </button>
        </form>
      </div>
    </div>

    <div id="modal-visualizar">
      <h3 id="visualizar-titulo">Detalhes do Usuário</h3>
      <p><strong>ID:</strong> <span id="view-id"></span></p>
      <p><strong>Nome:</strong> <span id="view-nome"></span></p>
      <p><strong>Email:</strong> <span id="view-email"></span></p>

      <p class="visualizar-senha-wrapper">
        <strong>Senha:</strong>
        <span id="view-senha">******</span>
        <i class="bi bi-eye-fill" id="toggle-view-senha"></i>
      </p>
      <button id="sair" onclick="fecharModal('modal-visualizar')">
        Fechar
      </button>
    </div>

    <div id="modal-editar">
  <h3>Editar Usuário</h3>
  
  <form class="modal-form" method="POST" action="/crudUsers/edit" onsubmit="return validarFormularioEditar(event)">
    
    <input type="hidden" name="id" id="editar-id">

    <div class="form-group">
      <label for="editar-nome">Nome:</label>
      <input type="text" id="editar-nome" name="name" value="<?= $user->name?>" required />
    </div>

    <div class="form-group">
      <label for="editar-email">Email:</label>
      <input type="email" id="editar-email" name="email" value="<?= $user->email ?>" required />
    </div>

    <div class="form-group">
      <label for="editar-senha">Senha:</label>
      <div class="input-wrapper">
        <input type="password" id="editar-senha" name="password" value="<?= $user->password?>" placeholder="****** " />
        <i class="bi bi-eye-fill toggle-senha" id="toggle-editar-senha"></i>
      </div>
    </div>

    <div class="form-group">
      <label for="editar-confirmar-senha">Confirmar Senha:</label>
      <div class="input-wrapper">
        <input type="password" id="editar-confirmar-senha" value="<?= $user->password ?>" placeholder="******" />
        <i class="bi bi-eye-fill toggle-senha" id="toggle-editar-confirmar"></i>
      </div>
    </div>

    <p id="modal-editar-erro" class="modal-erro"></p>

    <div class="modal-buttons">
      <button type="submit" id="btn-submit-editar" class="btn-salvar">
        Salvar
      </button>
      <button type="button" class="btn-cancelar" onclick="fecharModal('modal-editar')">
        Cancelar
      </button>
    </div>

  </form> </div>
      <p id="modal-editar-erro" class="modal-erro"></p>

      
    <?php endforeach; ?>
      </div>
    </div>

    <div id="modal-criar">
      <h3>Criar Novo Usuário</h3>
      <form class="modal-form" method="POST" action="/crudUsers/create">
        <div class="form-group">
          <label for="criar-nome">Nome:</label>
          <input type="text" id="criar-nome" name="name" required />
        </div>
        <div class="form-group">
          <label for="criar-email">Email:</label>
          <input type="email" id="criar-email" name="email" required />
        </div>

        <div class="form-group">
          <label for="criar-senha">Senha:</label>
          <div class="input-wrapper">
            <input type="password" id="criar-senha" name="password" required />
            <i class="bi bi-eye-fill toggle-senha" id="toggle-criar-senha"></i>
          </div>
        </div>
        <div class="form-group">
          <label for="criar-confirmar-senha">Confirmar Senha:</label>
          <div class="input-wrapper">
            <input type="password" id="criar-confirmar-senha" name="password" required />
            <i
              class="bi bi-eye-fill toggle-senha"
              id="toggle-criar-confirmar"
            ></i>
          </div>
        </div>
      

      <p id="modal-criar-erro" class="modal-erro"></p>

      <div class="modal-buttons">
        <button type="submit" id="btn-submit-criar" class="btn-salvar">
          Criar
        </button>
        </form>
        <button
          type="button"
          class="btn-cancelar"
          onclick="fecharModal('modal-criar')"
        >
          Cancelar
        </button>
      </div>
    </div>
  </body>
  <script src="../../../public/js/tabela_usuarios.js"></script>
</html>
