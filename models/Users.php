<?php

    class User {

        public $id;
        public $name;
        public $lastname;
        public $email;
        public $password;
        public $token;

        function generateToken() {

            return bin2hex(random_bytes(50));
        }

        function generatePassword($password) {

            return password_hash($password, PASSWORD_DEFAULT);
        }
    }

    interface userDaoInterface {

        public function buildUser($data);
        public function create(User $user, $authUser = false);
        public function update(User $user, $redirect = true);
        public function verifyToken($protectedPage = false);
        public function setTokenToSession($token, $redirect = true);
        public function authenticateUser($email, $password);
        public function findByEmail($email);
        public function findByToken($token);
        public function destroyToken();
        public function changePassword(User $user);
    }