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

            $dateBank = new DateBank();

            $dateBank->id = $data["id"];
            $dateBank->entry = $data["entry"];
            $dateBank->output = $data["output"];
            $dateBank->calendar = $data["calendar"];
            $dateBank->employees_id = $data["employees_id"];

            return $dateBank;
        }

        public function getDateBankByEmployeeId($id) {

            $dateBanks = [];

            $stmt = $this->conn->prepare("SELECT * FROM dateBank 
                WHERE employees_id = :employees_id
                ORDER BY id DESC
            ");

            $stmt->bindParam("employees_id", $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $dateBankArray = $stmt->fetchAll();

                foreach ($dateBankArray as $dateBank) {

                    $dateBanks[] = $this->buildDateBank($dateBank);
                }
            }

            return $dateBanks;
        }

        public function createPoint($dateBank) {

            $stmt = $this->conn->prepare("INSERT INTO 
            dateBank (id, entry, calendar, employees_id)
                VALUES (
                    :id, 
                    :entry,
                    :calendar,
                    :employees_id
                )

            ");

            $stmt->bindParam(":id", $dateBank->id);
            $stmt->bindParam(":entry", $dateBank->entry);
            $stmt->bindParam(":calendar", $dateBank->calendar);
            $stmt->bindParam(":employees_id", $dateBank->employees_id);

            $stmt->execute();

            $this->message->setMessage("Ponto de entrada criado com sucesso", "success", "back");
        }

        public function findById($id) {

                        
            $dateBank = [];

            $stmt = $this->conn->prepare("SELECT * FROM dateBank
                WHERE id = :id
            ");

            $stmt->bindParam(":id", $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $dateBankArray = $stmt->fetch();

                $dateBank = $this->buildDateBank($dateBankArray);

                return $dateBank;

            } else {

                return false;
            }
        }

        public function createOutputPoint($dateBank) {

            $stmt = $this->conn->prepare("UPDATE dateBank SET 
                output = :output
                WHERE id = :id
            ");

            $stmt->bindParam(":id", $dateBank->id);
            $stmt->bindParam(":output", $dateBank->output);

            /*print_r($dateBank->output);
            echo "<br> aaa";
            print_r($dateBank->id); exit;*/

            $stmt->execute();

            $this->message->setMessage("Ponto de saída criado com sucesso", "success", "back");
        }

        public function updatePoint($id) {


        }

        public function destroy() {


        }

    }