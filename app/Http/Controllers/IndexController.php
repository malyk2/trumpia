<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TrumpiaRestApi;

class IndexController extends Controller
{
    public function first()
    {
        \TrumpiaRestApi::get()->set();
    }

    public function list()
    {
        $all = TrumpiaRestApi::list()->get();
        dd($all);
    }
}
