<?php
    
    require_once("helpers/globals.php");
    require_once("helpers/db.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    //Message system
    $message = new Message($BASE_URL);

    $printMsg = $message->getMessage();

    //cleaning msg
    if (!empty($printMsg["msg"])) {

        $message->clearMessage();
    }

    //Check if the user is logged in
    $userDao = new UserDAO($conn, $BASE_URL);

    $userData = $userDao->verifyToken(false);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/e2f70584a0.js" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link rel="shortcut icon" href="<?= $BASE_URL ?>/uploads/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/css/style.css">
    <title>RH Control</title>
</head>
<body>
    <header>
        <nav id="main-navbar" class="navbar navbar-expand-lg">
            <a href="<?= $BASE_URL ?>" class="navbar navbar-brand">
                <img src="<?= $BASE_URL ?>/uploads/logo.png" alt="logo" id="logo">
                <span id="rh-title">RH Control</span>
            </a>
            <button 
                class="navbar-toggler"
                type="button"
                data-toglle="collapse"
                data-target="#navbar"
                aria-controls="navbar"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <i class="fas fa-bars"></i>
            </button>
            <div class="cllapse navbar-collapse" id="navbar">
                <ul class="navbar-nav">
                    <?php if ($userData): ?>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>/dashboard.php" class="nav-link">
                                Meus Colaboradores
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>/createEmployee.php" class="nav-link ">
                                <i class="fa-regular fa-square-plus"></i> Criar Colaborador
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>/editProfile.php" class="nav-link bold ">
                                <?= $userData->name ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>/logout.php" class="nav-link ">
                                Sair
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>/authentication.php" class="nav-link">
                                Entrar / Cadastrar
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>
    <?php if (!empty($printMsg["msg"])): ?>
        <div class="msg-container">
            <p class="msg <?= $printMsg["type"] ?>">
                <?= $printMsg["msg"] ?>
            </p>
        </div>
    <?php endif; ?>