<?php

    $host = "localhost";
    $user = "root";
    $pass = "password";
    $db = "rhcontrol";

    $conn = new PDO("mysql:host=$hosy;dbname=$db", $user, $pass);

    //errors in development state
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);