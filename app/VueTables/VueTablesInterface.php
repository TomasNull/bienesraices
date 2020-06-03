<?php

namespace App\VueTables;

Interface VueTablesInterface {
    public function get($table, Array $fields, Array $relations = []);
}