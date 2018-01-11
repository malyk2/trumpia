<?php

namespace Divart\Trumpia;

use \GuzzleHttp\Client;
//use Divart\Trumpia\Common\AllCompanies;
use Divart\Trumpia\Common\Requests\ListRequest;
// use Divart\Trumpia\Common\Request;

class TrumpiaRestApi
{
    public function __construct()
    {
        //$this->request = $request;
    }

    public function allCompanies()
    {
        return new AllCompanies();
    }

    public function list()
    {
        return new ListRequest();
    }

    public function set()
    {
        dump('set');
    }

    private function init()
    {
        dd('init');
    }
}
