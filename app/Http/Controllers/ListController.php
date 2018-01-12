<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Divart\Trumpia\Facades\TrumpiaRestApi;

class ListController extends Controller
{
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

    public function create(Request $request)
    {
        $create = TrumpiaRestApi::list()->create($request->all());
        dd($create);
    }

    public function update(Request $request, $id)
    {
        $update = TrumpiaRestApi::list()->update($id, $request->all());
        dd($update);
    }

    public function delete($id)
    {
        $delete = TrumpiaRestApi::list()->delete($id);
        dd($delete);
    }
}
