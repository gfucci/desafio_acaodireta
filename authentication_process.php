<?php

    require_once("helpers/db.php");
    require_once("helpers/globals.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $userDao = new UserDAO($conn, $BASE_URL);
    $message = new Message($BASE_URL);

    //GET FORM TYPE
    $type = filter_input(INPUT_POST, "type");

    if ($type === "register") {

        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirmPassword = filter_input(INPUT_POST, "confirmpassword");
        
        //form min validation
        if ($name && $lastname && $email && $password) {

            //password validation
            if ($password === $confirmPassword) {

                if ($userDao->findByEmail($email) === false) {

                    $user = new User();

                    //create token and hash
                    $userToken = $user->generateToken();
                    $finalPassword = $user->generatePassword($password);

                    $user->name = $name;
                    $user->lastname = $lastname;
                    $user->email = $email;
                    $user->password = $finalPassword;
                    $user->token = $userToken;

                    //login after create account
                    $auth = true;

                    $userDao->create($user, $auth);

                } else {

                    //Enviar msg de erro, email já existente
                    $message->setMessage("Usuário ja cadastrado, tente outro e-mail", "error", "back");
                }

            } else {

                $message->setMessage("As senhas não correspondem", "error", "back");
            }

        } else {

            $message->setMessage("Por favor,  insira todos os campos!", "error", "back");
        }

        //login container
    } else if ($type === "login") {

    } else {

        //malicious data
        $message->setMessage("Algo deu errado!", "error");
    }