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
                <p class="page-description">Este projeto full stack tem como objetivo apresentar um controle de ponto de funcionários. Feito com php sem framework e MySQL.</p>
                <button type="submit" class="btn card-btn" id="date-btn">
                    <i class="fa-regular fa-calendar-plus"></i> Código do Projeto
                </button>
            </div>
        <?php else: ?>
            <div class="offset-md-4 col-md-4 new-movie-container">
                <h1 class="page-title">Projeto RH Control</h1>
                <p class="page-description">Este projeto full stack tem como objetivo apresentar um controle de ponto de funcionários. Feito com php sem framework e MySQL.</p>
                <button type="submit" class="btn card-btn" id="date-btn">
                    <i class="fa-regular fa-calendar-plus"></i> Começar Agora
                </button>
                <button type="submit" class="btn card-btn" id="date-btn">
                    <i class="fa-regular fa-calendar-plus"></i> Código do Projeto
                </button>
            </div>
        <?php endif; ?>
    </div>
<?php

    require_once("templates/footer.php");

?>