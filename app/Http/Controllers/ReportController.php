<?php

namespace App\Http\Controllers;

use Divart\Trumpia\Facades\TrumpiaRestApi;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index($id)
    {
        $report = TrumpiaRestApi::statusReport($id)->get($id);
        dd($report);
    }
}
