<?php

    require_once("helpers/db.php");
    require_once("helpers/globals.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $userDao = new UserDAO($conn, $BASE_URL);
    $message = new Message($BASE_URL);

    //GET FORM TYPE
    $type = filter_input(INPUT_POST, "type");

    if ($type === "create") {

        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $occupation = filter_input(INPUT_POST, "occupation");
        
        //form min validation
        if ($name && $lastname && $occupation) {

            

        } else {

            $message->setMessage("Por favor,  insira todos os campos!", "error", "back");
        }

        //login container
    } else {

        //malicious data
        $message->setMessage("Algo deu errado!", "error");
    }