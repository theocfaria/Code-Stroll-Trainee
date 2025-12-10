<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre nós</title>
    <link rel="stylesheet" href="../../../public/css/sobre_nos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Shantell+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>
    <?php require __DIR__ . '/navbar.view.php'; ?>
    <div class ="pagina">
        <div class="introducao">
            <div class="sobre_nos">
                <p class="texto-sn title">Sobre Nós</p>
                <p class="texto-sn" id="txt_sn">Somos um blog dedicado a compartilhar conhecimento sobre programação de forma simples, prática e acessível. Nosso foco é ajudar estudantes, profissionais e entusiastas da tecnologia a aprimorar suas habilidades, entender conceitos complexos e acelerar sua jornada no mundo do desenvolvimento. Acreditamos que aprender a programar transforma vidas e abre portas para oportunidades reais — e queremos fazer parte dessa evolução.</p>
            </div>
            <div class="img_logo">
                <img src="../../../public/assets/exemplo_sobrenos.jpg" alt="" id="primary_img">
                <div class="logos-sn">
                    <i class="bi-sn bi-globe li-sn"></i>
                    <i class="bi-sn bi-code-slash li-sn"></i>
                    <i class="bi-sn bi-cpu li-sn"></i>
                </div>  
            </div>
        </div>
        <div class="mvv">
            <div class="missao cards">
                    <p class="texto-sn title-mvv">Missão</p>
                    <p class="texto-sn txt">Nossa missão é democratizar o aprendizado em programação, oferecendo conteúdo de qualidade, exemplos práticos, tutoriais completos e soluções de problemas reais. Buscamos inspirar e capacitar pessoas a dominarem tecnologias modernas, desenvolvendo confiança e autonomia no processo de aprendizagem.</p>
                <button class="botao">
                    <i class="bi-sn bi-bullseye"></i>
                </button>
            </div>
            <div class="visao cards">
                    <p class="texto-sn title-mvv">Visão</p>
                    <p class="texto-sn txt">Nossa visão é ser reconhecido como um dos principais pontos de referência para quem busca aprender programação de forma clara, eficiente e atualizada, construindo uma comunidade forte, colaborativa e engajada que acompanhe o avanço constante da tecnologia.</p>
                <button class="botao"><i class="bi-sn bi-eye"></i></button>   
            </div>
            <div class="valores cards">
                    <p class="texto-sn title-mvv">Valores</p>
                    <p class="texto-sn txt">Nossos valores incluem clareza e simplicidade na comunicação, transparência em tudo o que fazemos, busca constante por atualização, incentivo à colaboração, compromisso com a qualidade dos conteúdos e paixão genuína por tecnologia.</p>
                <button class="botao"><i class="bi-sn bi-person-hearts"></i></button>
            </div>
        </div>
    </div>
<?php require __DIR__ . '/footer.view.php'; ?>
</body>
</html>