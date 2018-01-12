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
            'list_name' => 'description',
            'display_name' => 'Display name Testlist2',
            'frequency' => 122,
            'description' => 'descriptionTestlist2'
        ];
        $create = TrumpiaRestApi::list()->create($data);
        dd($create);
    }

    public function update($id)
    {
        $data = [
            'list_name' => 'descriptionupdated',
            'display_name' => 'Display name Testlist2 updated',
            'frequency' => 100,
            'description' => 'updated'
        ];
        $update = TrumpiaRestApi::list()->update($id, $data);
        dd($update);
    }

    public function delete($id)
    {
        $delete = TrumpiaRestApi::list()->delete('2199079');
        dd($delete);
    }

}
