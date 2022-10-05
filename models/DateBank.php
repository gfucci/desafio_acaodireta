<?php

    class DateBank {

        public $id;
        public $entry;
        public $exit;
        public $date;
        public $employees_id;
        public $users_id;
    }

    interface DateBankDaoInterface {

        public function buildDateBank($data);
        public function create($entry, $exit);
        public function getDatesBank($id);
        public function destroy();
    }