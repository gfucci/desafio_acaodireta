<?php

    require_once("helpers/globals.php");
    require_once("helpers/db.php");
    require_once("templates/header.php");
    require_once("dao/UserDAO.php");

    $userDao = new UserDAO($conn, $BASE_URL);
    $userData = $userDao->verifyToken(false);
?>

<div id="main-container" class="container-fluid">
    <?php if ($userData): ?>
        <div class="offset-md-4 col-md-4 new-movie-container">
            <h1 class="page-title">Projeto RH Control</h1>
            <p class="page-description" id="index-description">Este projeto full stack tem como objetivo apresentar um controle de ponto de funcionários. Feito com php sem framework e MySQL.</p>
            <button class="btn card-btn" id="date-btn">
                <a 
                    href="https://github.com/gfucci/projeto_RH-Control_php" 
                    rel="noopener noreferrer" 
                    target="_blank"
                >
                    <i class="fa-brands fa-github-alt"></i> Código do Projeto
                </a>
            </button>
        </div>
    <?php else: ?>
        <div class="offset-md-4 col-md-4 new-movie-container">
            <h1 class="page-title">Projeto RH Control</h1>
            <p class="page-description" id="index-description">Este projeto full stack tem como objetivo apresentar um controle de ponto de funcionários.</p>
            <p class="page-description" id="index-description">Feito com PHP sem framework, MySQL, bootstrap, jQuery e outros...</p>
            <button class="btn card-btn" id="date-btn">
                <a href="<?= $BASE_URL ?>authentication.php">
                    <i class="fa-solid fa-play"></i> Começar Agora
                </a>
            </button>
            <button class="btn card-btn" id="date-btn">
                <a 
                    href="https://github.com/gfucci/projeto_RH-Control_php" 
                    rel="noopener noreferrer" 
                    target="_blank"
                >
                    <i class="fa-brands fa-github-alt"></i> Código do Projeto
                </a>
            </button>
        </div>
    <?php endif; ?>
</div>

<?php require_once("templates/footer.php"); ?>