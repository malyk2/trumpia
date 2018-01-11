<?php
namespace Divart\Trumpia\Common;

class AllCompanies extends RestRequest
{
    public function __construct()
    {
        $this->method = 'GET';
        $this->uri = 'list';
        parent::__construct();
    }



}
