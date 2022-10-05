<?php

    require_once("helpers/db.php");
    require_once("helpers/globals.php");
    require_once("models/Message.php");
    require_once("models/DateBank.php");
    require_once("dao/UserDAO.php");
    require_once("dao/DateBankDAO.php");

    $message = new Message($BASE_URL);
    $userDao = new UserDAO($conn, $BASE_URL);
    $dateBankDao = new DateBankDAO($conn, $BASE_URL);

    $userData = $userDao->verifyToken(true);

    //get form type
    $type = filter_input(INPUT_POST, "type");

    //employee entry
    if ($type === "entry") {

        //get employee id
        $id = filter_input(INPUT_POST, "id");

        if ($id) {

            $date = date("d/m/Y");
            $hour = date("G:i:s", time());

            $dateBank = new DateBank();

            $dateBank->employees_id = $id;
            $dateBank->calendar = $date;
            $dateBank->entry = $hour;

            $dateBankDao->create($dateBank);

        } else {

            //malicious data
            $message->setMessage("Usuário não encontrado", "error");
        }
        
        //employee exit
    } else if ($type === "output") {


    
        //if the user entered misleading data
    } else if ($type === "delete") {



    } else {

        //malicious data
        $message->setMessage("Algou deu Errado", "error");
    }