<?php

    require_once("helpers/globals.php");
    require_once("helpers/db.php");
    require_once("models/Users.php");

    class UserDAO implements userDaoInterface {

        private $conn;
        private $url;

        public function __construct($conn, $url) {

            $this->conn = $conn;
            $this->url = $url;
        }

        public function buildUser($data) {

            $user = new User();

            $user->id = $data["$id"];
            $user->name = $data["$name"];
            $user->lastname = $data["$lastname"];
            $user->email = $data["$email"];
            $user->password = $data["$password"];
            $user->image = $data["$image"];
            $user->token = $data["$token"];
        }

        public function create(User $user, $authUser = false) {


        }

        public function update(User $user, $redirect = true) {


        }

        public function verifyToken($protectedPage = false) {


        }

        public function setTokenToSession($token, $redirect = true) {


        }

        public function authenticateUser($email, $password) {


        }

        public function findByEmail($email) {


        }

        public function findById($id) {


        }

        public function findByToken($token) {


        }

        public function destroyToken() {


        }

        public function changePassword($password) {


        }

    }