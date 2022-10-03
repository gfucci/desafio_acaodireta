<?php
    
    require_once("helpers/globals.php");
    require_once("helpers/db.php");

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
                    <li class="nav-item">
                        <a href="<?= $BASE_URL ?>" class="nav-link">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link bold ">
                            usuario
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $BASE_URL ?>/authentication.php" class="nav-link">
                            Entrar / Cadastrar
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>