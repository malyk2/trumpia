<?php

namespace Divart\Trumpia;

// use \GuzzleHttp\Client;
//use Divart\Trumpia\Common\AllCompanies;
use Divart\Trumpia\Common\Requests\ListRequest;
// use Divart\Trumpia\Common\Request;

class TrumpiaRestApi
{
    public function __construct()
    {
    }

    public function list()
    {
        return new ListRequest();
    }
}
