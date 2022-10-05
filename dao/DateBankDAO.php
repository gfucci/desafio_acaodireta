<?php

    require_once("helpers/globals.php");
    require_once("helpers/db.php");
    require_once("models/DateBank.php");

    class DateBankDAO implements DateBankDaoInterface {

        private $conn;
        private $url;
        private $message;

        public function __construct($conn, $url) {

            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function buildDateBank($data) {

            $dateBank = new buildDateBank();

            $dateBank->id = $data["id"];
            $dateBank->entry = $data["entry"];
            $dateBank->exit = $data["exit"];
            $dateBank->date = $data["date"];
            $dateBank->employees_id = $data["employees_id"];
            $dateBank->users_id = $data["users_id"];

            return $dateBank;
        }

        public function create($entry, $exit) {


        }

        public function getDatesBank($id) {


        }

        public function destroy() {


        }

    }