<?php

    require_once("helpers/globals.php");
    require_once("helpers/db.php");
    require_once("models/Users.php");

    class UserDAO implements userDaoInterface {

        private $conn;
        private $url;
        private $message;

        public function __construct($conn, $url) {

            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function buildUser($data) {

            $user = new User();

            $user->id = $data["id"];
            $user->name = $data["name"];
            $user->lastname = $data["lastname"];
            $user->email = $data["email"];
            $user->password = $data["password"];
            $user->image = $data["image"];
            $user->token = $data["token"];

            return $user;
        }

        public function create(User $user, $authUser = false) {

            $stmt = $this->conn->prepare("INSERT INTO users 
                (name, lastname, email, password, token)
                VALUES (:name, :lastname, :email, :password, :token)
            ");

            $stmt->bindParam(":name", $user->name);
            $stmt->bindParam(":lastname", $user->lastname);
            $stmt->bindParam(":email", $user->email);
            $stmt->bindParam(":password", $user->password);
            $stmt->bindParam(":token", $user->token);

            $stmt->execute();

            //login user when create account
            if ($authUser) {
                $this->setTokenToSession($user->token, true);
            }
        }        

        public function update(User $user, $redirect = true) {


        }

        public function setTokenToSession($token, $redirect = true) {

            $_SESSION["token"] = $token;

            if ($redirect) {

                //redirect to perfil page
                $this->message->setMessage("Seja bem-vindo", "success", "/editProfile.php");
            }
        }

        public function verifyToken($protectedPage = false) {

            if (!empty($_SESSION["token"])) {
              
                //get token
                $token = $_SESSION["token"];

                $user = $this->findByToken($token);

                if ($user) {

                    return $user;

                } else if ($protectedPage) {

                    //redirect no authentication user
                    $this->message->setMessage("Faça a autenticação para usar o sistema.", "error");
                }

            } else if ($protectedPage) {

                //redirect no authentication user
                $this->message->setMessage("Faça a autenticação para usar o sistema.", "error");
            }
        }

        public function authenticateUser($email, $password) {


        }

        public function findByEmail($email) {

            if ($email != "") {

                $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
                $stmt->bindParam(":email", $email);
                $stmt->execute();

                //create user in database
                if ($stmt->rowCount() > 0) {

                    $data = $stmt->fetch();
                    $user = $this->buildUser($data);

                    return $user;

                } else {

                    return false;
                }

            } else {

                return false;
            }
        }

        public function findById($id) {


        }

        public function findByToken($token) {

            if ($token != "") {

                $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");
                $stmt->bindParam(":token", $token);
                $stmt->execute();

                //create user in database
                if ($stmt->rowCount() > 0) {

                    $data = $stmt->fetch();
                    $user = $this->buildUser($data);

                    return $user;

                } else {

                    return false;
                }

            } else {

                return false;
            }
        }

        public function destroyToken() {


        }

        public function changePassword($password) {


        }

    }