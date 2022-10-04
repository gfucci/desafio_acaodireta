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

            $employee->id = $data["id"];
            $employee->name = $data["name"];
            $employee->lastname = $data["lastname"];
            $employee->image = $data["image"];
            $employee->occupation = $data["occupation"];
            $employee->users_id = $data["users_id"];

            return $employee;
        }

        public function findAll() {

        }

        public function getLatestEmployee() {

        }

        public function getEmployeeByOccupation($occupation) {

        }

        public function getEmployeeByUserId($id) {

            $employees = [];

            $stmt = $this->conn->prepare("SELECT * FROM employees
                WHERE users_id = :users_id
                ORDER BY id DESC
            ");

            $stmt->bindParam(":users_id", $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $employeesArray = $stmt->fetchAll();
                
                foreach ($employeesArray as $employee) {

                    $employees[] = $this->buildEmployee($employee);
                }
            }

            return $employees;
        }

        public function findById($id) {

                        
            $employee = [];

            $stmt = $this->conn->prepare("SELECT * FROM employees
                WHERE id = :id
            ");

            $stmt->bindParam(":id", $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $employeeArray = $stmt->fetch();

                $employee = $this->buildEmployee($employeeArray);

                return $employee;

            } else {

                return false;
            }
        }

        public function findByName($name) {

        }

        public function create(Employee $employee) {

            $stmt = $this->conn->prepare("INSERT INTO employees 
            (name, lastname, image, occupation, users_id)
            VALUES (:name, :lastname, :image, :occupation, :users_id)
            ");

            

            $stmt->bindParam(":name", $employee->name);
            $stmt->bindParam(":lastname", $employee->lastname);
            $stmt->bindParam(":image", $employee->image);
            $stmt->bindParam(":occupation", $employee->occupation);
            $stmt->bindParam(":users_id", $employee->users_id);

            $stmt->execute();

            $this->message->setMessage("Colaborador criado com sucesso", "success");
        }

        public function update(Employee $employee) {

            $stmt = $this->conn->prepare("UPDATE employees SET 
                name = :name,
                lastname = :lastname,
                occupation = :occupation,
                image = :image
                WHERE id = :id
            ");
            

            $stmt->bindParam(":name", $employee->name);
            $stmt->bindParam(":lastname", $employee->lastname);
            $stmt->bindParam(":image", $employee->image);
            $stmt->bindParam(":occupation", $employee->occupation);
            $stmt->bindParam(":id", $employee->id);

            $stmt->execute();

            //print_r($employee->users_id); exit;

            $this->message->setMessage("Colaborador editado com sucesso", "success", "/dashboard.php");
        }

        public function destroy($id) {

            $stmt = $this->conn->prepare("DELETE FROM employees WHERE id = :id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $this->message->setMessage("Filme deletado com sucesso", "success", "/dashboard.php");
        }
    }