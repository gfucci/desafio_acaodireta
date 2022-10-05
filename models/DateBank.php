<?php

    class DateBank {

        public $id;
        public $entry;
        public $output;
        public $date;
        public $employees_id;
        public $users_id;
    }

    interface DateBankDaoInterface {

        public function buildDateBank($data);
        public function getDateBankByEmployeeId($id);
        public function createPoint($dateBank);
        public function updatePoint($id);
        public function destroy();
    }