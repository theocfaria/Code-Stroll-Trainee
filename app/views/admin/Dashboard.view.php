<?php
    session_start();

    if(!isset($_SESSION['id'])){
        header("Location: /login");
    }
?>

<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../../public/css/dashboard.css">
</head>

<body>
    <div id="container">
        <div id="links">
            <a href="/lista_usuarios" id="usuarios"><i class="bi bi-person-fill-gear"> Tabela de Usuários </i></a>
            <a href="/tabela_posts" id="posts"><i class="bi bi-table "> Tabela de Posts </i></a>
        </div>
        
        <div id="contem-logout">
            <form action="/logout" method="POST">
                <button id="logout" type="submit">Logout</button>
            </form>
            </div>
    </div>

</body>

</html>