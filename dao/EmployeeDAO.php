<?php

    require_once("helpers/globals.php");
    require_once("helpers/db.php");
    require_once("models/Employees.php");

    class EmployeeDAO implements employeeDaoInterface {

        private $conn;
        private $url;
        private $message;

        public function __construct($conn, $url) {

            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function buildEmployee($data) {

            $employee = new Employee();

            $user->id = $data["id"];
            $user->name = $data["name"];
            $user->lastname = $data["lastname"];
            $user->image = $data["image"];
            $user->occupation = $data["occupation"];
            $user->users_id = $data["users_id"];

            return $employee;
        }

        public function findAll() {

        }

        public function getLatestEmployee() {

        }

        public function getMovieByOccupation($occupation) {

        }

        public function getMovieByUserId($id) {

        }

        public function findById($id) {

        }

        public function findByName($name) {

        }

        public function create(Employee $employee) {

        }

        public function update(Employee $employee) {

        }

        public function destroy($id) {

        }

    }