<?php

    class Employee {

        public $id;
        public $name;
        public $lastname;
        public $image;
        public $occupation;
        public $users_id;

        public function generateImageName() {

            return bin2hex(random_bytes(60)) . ".jpg";
        }
    }

    interface employeeDaoInterface {

        public function buildEmployee($data);
        public function getEmployeeByUserId($id);
        public function findById($id);
        public function create(Employee $employee);
        public function update(Employee $employee);
        public function destroy($id);
    }