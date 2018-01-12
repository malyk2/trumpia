<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Divart\Trumpia\Facades\TrumpiaRestApi;

class ListController extends Controller
{
    public function first()
    {
    }

    public function all()
    {
        $all = TrumpiaRestApi::list()->get();
        dd($all);
    }

    public function item($id = 2197554)
    {
        $item = TrumpiaRestApi::list()->get($id);
        dd($item);
    }

    public function create()
    {
        $data = [
            'list_name' => 'Testlist1',
            'display_name' => 'Display name Testlist1',
            'frequency' => 100,
            'description' => 'asaddasd'
        ];
        $create = TrumpiaRestApi::list()->create($data);
        dd($create);
    }

}
