<?php
    require_once("templates/header.php");

    print_r($userData);

    if ($userDao) {
        $userDao->destroyToken();
    }
?>