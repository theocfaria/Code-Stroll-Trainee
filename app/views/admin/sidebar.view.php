<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/public/css/sidebar.css" />
    <script
      src="https://kit.fontawesome.com/36d5ddc114.js"
      crossorigin="anonymous"
    ></script>
    <title>Sidebar</title>
  </head>
  <body>
    <aside class="sidebar" id="sidebar">
      <div class="top-sidebar">
        <div id="perfil-sidebar">
          <img src="/public/assets/img3 (1).png" alt="foto de perfil do usuário" />
          <i class="fa-solid fa-chevron-left toggle-sidebar"></i>
        </div>
        <nav class="content-sidebar">
          <ul>
            <li class="item-sidebar">
              <a href="/">
                <i class="fa-solid fa-house"></i>
                <span class="item-description">Página inicial</span>
              </a>
            </li>
            <li class="item-sidebar active">
              <a href="/dashboard">
                <i class="fa-solid fa-chart-column"></i>
                <span class="item-description">Dashboard</span>
              </a>
            </li>
            <li class="item-sidebar">
              <a href="/lista-de-posts">
                <i class="fa-solid fa-pen-to-square"></i>
                <span class="item-description">Publicações</span>
              </a>
            </li>
            <li class="item-sidebar">
              <a href="/crudUsers">
                <i class="fa-solid fa-user-pen"></i>
                <span class="item-description">Úsuários</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>

      <div class="logout-sidebar">
        <form action="/logout" method="POST">
          <button type="submit" id="button-logout">
          <i class="fa-solid fa-right-from-bracket" id="icon-logout"></i>
          <span class="item-description">Logout</span>
          </button>
        </form>  
      </div>
    </aside>
  </body>
  <script src="/public/js/sidebar.js"></script>
</html>