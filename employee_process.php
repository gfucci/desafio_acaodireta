<?php

    require_once("helpers/db.php");
    require_once("helpers/globals.php");
    require_once("models/Message.php");
    require_once("dao/EmployeeDAO.php");
    require_once("dao/UserDAO.php");

    $employeeDao = new EmployeeDAO($conn, $BASE_URL);
    $userDao = new UserDAO($conn, $BASE_URL);
    $message = new Message($BASE_URL);

    //GET FORM TYPE
    $type = filter_input(INPUT_POST, "type");

    //get user
    $userData = $userDao->verifyToken(true);

    if ($type === "create") {

        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $occupation = filter_input(INPUT_POST, "occupation");

        $employee = new Employee();
        
        //form min validation
        if ($name && $lastname && $occupation) {

            $employee->name = $name;
            $employee->lastname = $lastname;
            $employee->occupation = $occupation;
            $employee->users_id = $userData->id;

            /*print_r($_FILES); 
            echo "<br> <br>";
            print_r($_POST); 
            echo "<br> <br>";
            print_r($_FILES["image"]);
            echo "<br> <br>";
            print_r($_FILES["image"]["tmp_name"]);
            echo "<br> <br>";*/
            //exit;

            //upload employee image
            if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

                //echo "caiu no if"; exit;

                $image = $_FILES["image"];
                $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
                $jpgArray = ["image/jpeg", "image/jpg"];

                //check image type
                if (in_array($image["type"], $imageTypes)) {

                    //check if is jpg
                    if(in_array($image["type"], $jpgArray)) {

                        //echo "caiu no if createimage"; exit;
                        $imageFile = imagecreatefromjpeg($image["tmp_name"]);

                    } else {

                        //echo "caiu no else createimage"; exit;
                        $imageFile = imagecreatefrompng($image["tmp_name"]);
                    }

                    //generate image name
                    $imageName = $employee->generateImageName();

                    imagejpeg($imageFile, "./uploads/employees/" . $imageName, 100);

                    $employee->image = $imageName;
                    
                } else {

                    $message->setMessage("Tipo de imagem incorreto", "error", "back");
                    die;
                }

            }

            $employeeDao->create($employee);

        } else {

            $message->setMessage("Por favor,  insira todos os campos!", "error", "back");
            die;
        }

        //login container
    } else if ($type === "delete") {

        $id = filter_input(INPUT_POST, "id");

        $employee = $employeeDao->findById($id);

        //check if have emoloyee
        if ($employee) {

            if ($employee->users_id === $userData->id) {

                $employeeDao->destroy($employee->id);

            } else {

                $message->setMessage("Não foi possível deletar!", "error");
                die;
            }

        } else {

            $message->setMessage("Não foi possível deletar!", "error");
            die;
        }

    } else if ($type === "update") {

        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $occupation = filter_input(INPUT_POST, "occupation");
        $id = filter_input(INPUT_POST, "id");

        $employeeData = $employeeDao->findById($id);

        //print_r($employeeData); exit;
        
        //form min validation
        if ($name && $lastname && $occupation) {

            $employeeData->name = $name;
            $employeeData->lastname = $lastname;
            $employeeData->occupation = $occupation;
            $employeeData->users_id = $userData->id;

            //upload employee image
            if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

                //echo "caiu no if"; exit;

                $image = $_FILES["image"];
                $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
                $jpgArray = ["image/jpeg", "image/jpg"];

                //check image type
                if (in_array($image["type"], $imageTypes)) {

                    //check if is jpg
                    if(in_array($image["type"], $jpgArray)) {

                        //echo "caiu no if createimage"; exit;
                        $imageFile = imagecreatefromjpeg($image["tmp_name"]);

                    } else {

                        //echo "caiu no else createimage"; exit;
                        $imageFile = imagecreatefrompng($image["tmp_name"]);
                    }

                    //generate image name
                    $imageName = $employeeData->generateImageName();

                    imagejpeg($imageFile, "./uploads/employees/" . $imageName, 100);

                    $employeeData->image = $imageName;
                    
                } else {

                    $message->setMessage("Tipo de imagem incorreto", "error", "back");
                    die;
                }

            }

            $employeeDao->update($employeeData);

        } else {

            $message->setMessage("Por favor,  insira todos os campos!", "error", "back");
            die;
        }

    } else {

        //malicious data
        $message->setMessage("Algo deu errado!", "error");
    }