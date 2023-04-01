<?php

namespace App\Repositories;
class Base {

    public function create($table, $input) {
        DB::table($table)
            ->create($input);
    }
}
