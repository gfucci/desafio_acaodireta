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

            $dateBankDao->createPoint($dateBank);

        } else {

            //malicious data
            $message->setMessage("Usuário não encontrado", "error");
        }
        
        //employee exit
    } else if ($type === "output") {

        //get employee id
        $id = filter_input(INPUT_POST, "id");

        $dateBankDate = $dateBankDao->findById($id);
        //print_r($dateBankDate);exit;

        //check if exist date data
        if ($dateBankDate->id) {

            if ($dateBankDate->entry) {

                $hour = date("G:i:s", time());

                $dateBank = new DateBank();

                $dateBankDate->employees_id = $id;
                $dateBankDate->output = $hour;


                $dateBankDao->createOutputPoint($dateBankDate);

            } else {

                $message->setMessage("Só é possivel adicionar um ponto de saída se houver um de entrada!", "error", "back");
            }

        } else {

            //malicious data
            $message->setMessage("Usuário não encontrado", "error");
        }
    
        //if the user entered misleading data
    } else if ($type === "delete") {



    } else {

        //malicious data
        $message->setMessage("Algou deu Errado", "error");
    }