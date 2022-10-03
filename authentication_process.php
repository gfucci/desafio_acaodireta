<?php

    require_once("helpers/db.php");
    require_once("helpers/globals.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $userDao = new UserDAO($conn, $BASE_URL);
