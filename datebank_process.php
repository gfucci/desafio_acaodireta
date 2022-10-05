<?php

    require_once("helpers/db.php");
    require_once("helpers/globals.php");
    require_once("models/Message.php");
    require_once("models/DateBank.php");
    require_once("dao/UserDAO.php");
    require_once("dao/DateBankDAO.php");
    require_once("dao/EmployeeDAO.php");

    $message = new Message($BASE_URL);
    $userDao = new UserDAO($conn, $BASE_URL);
    $employeeDao = new EmployeeDAO($conn, $BASE_URL);
    $dateBankDao = new DateBankDAO($conn, $BASE_URL);

    $userData = $userDao->verifyToken(true);
    

    //print_r($userData); exit;
    
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
            die;
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

                //malicious data
                $message->setMessage("Só é possivel adicionar um ponto de saída se houver um de entrada!", "error", "back");
                die;
            }

        } else {

            //malicious data
            $message->setMessage("Usuário não encontrado", "error");
            die;
        }
    
        //if the user entered misleading data
    } else if ($type === "delete") {

        $id = filter_input(INPUT_POST, "id");

        $dateBank = $dateBankDao->findById($id);
        $employeeData = $employeeDao->findById($dateBank->employees_id);

        //check if have date data
        if ($dateBank) {

            //check PK and FK
            if ($dateBank->employees_id === $employeeData->id) {

                $dateBankDao->destroy($dateBank->id);

            } else {

                $message->setMessage("Não foi possível deletar!", "error");
                die;
            }

        } else {

            $message->setMessage("Não foi possível deletar!", "error");
            die;
        }

    } else {

        //malicious data
        $message->setMessage("Algou deu Errado", "error");
    }