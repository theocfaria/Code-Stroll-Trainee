<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap"
        rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../../public/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div id="container">
        <div id="Retangulo">
            <div id="xis">
                <a id="x" href="navbar.html"><i class="bi bi-x"></i></a>
            </div>
            <img src="../../../public/assets/logotipo.png" alt="Logotipo" id="logo">
            <p id="login">Login</p>
            <form action="/login" method="POST">
                <div class="mensagem-erro">
                    <p>
                        <?php
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }

                        if (isset($_SESSION['mensagem-erro'])) {
                            echo $_SESSION['mensagem-erro'];
                            unset($_SESSION['mensagem-erro']);
                        }
                        ?>
                    </p>
                </div>
                <div class="container-input">
                    <input type="text" name="email" placeholder="E-mail:" id="email" required>
                    <div class="container-senha">
                        <input type="password" name="senha" placeholder="Senha:" id="senha" required>
                        <i class="bi bi-eye-slash" id="olhoIcon" onclick="alternaOlho()"></i>
                    </div>
                </div>
                <div class="container-entrar">
                    <button type="submit" id="entrar">Entrar</button>
                </div>
                <div class="container-cadastro">
                    <p id="texto-cadastro">Não possui conta? <a href="cadastro" id="link-cadastro">Cadastre-se!</a></p>
                </div>

            </form>
        </div>
    </div>
</body>
<script src="../../../public/js/login.js"></script>

</html>