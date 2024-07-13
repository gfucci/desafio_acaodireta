<?php

session_start();

$name = $_SERVER["SERVER_NAME"];
$protocol = $_SERVER["SERVER_PORT"];
$BASE_URL = "http://$name:$protocol" . dirname($_SERVER["REQUEST_URI"] . "?");

error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set('memory_limit', -1);