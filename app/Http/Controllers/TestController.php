<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test($value) {
        $test = $value + 5;
        return phpinfo();
    }
}
