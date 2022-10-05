<?php

    require_once("helpers/db.php");
    require_once("helpers/globals.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $userDao = new UserDAO($conn, $BASE_URL);
    $message = new Message($BASE_URL);

    //get form type
    $type = filter_input(INPUT_POST, "type");

    if ($type === "update") {

        //get user database
        $userData = $userDao->verifyToken(false);

        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");

        $userData->name = $name;
        $userData->lastname = $lastname;
        $userData->email = $email;
        
        $userDao->update($userData, true);

        //login container
    } else if ($type === "changepassword") {

        $userData = $userDao->verifyToken(false);

        $password = filter_input(INPUT_POST, "password");
        $confirmPassword = filter_input(INPUT_POST, "confirmpassword");

        if ($password === $confirmPassword) {

            $updatedPassword = $userData->generatePassword($password);  

            $userData->password = $updatedPassword;

            $userDao->changePassword($userData);

        } else {

            $message->setMessage("As senha não são iguais, tente novamente!", "error", "back");
        }

    } else {

        //malicious data
        $message->setMessage("Algo deu errado!", "error");
    }