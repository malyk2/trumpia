<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Divart\Trumpia\Facades\TrumpiaRestApi;

class SubscriptionController extends Controller
{
    public function all()
    {
        $all = TrumpiaRestApi::subscription()->get();
        dd($all);
    }

    public function item($id)
    {
        $item = TrumpiaRestApi::list()->get($id);
        dd($item);
    }

    public function create(Request $request)
    {
        $create = TrumpiaRestApi::subscription()->create($request->all());
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
