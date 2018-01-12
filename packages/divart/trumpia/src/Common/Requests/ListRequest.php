<?php
namespace Divart\Trumpia\Common\Requests;

use Divart\Trumpia\Common\RestRequest;

class ListRequest extends RestRequest
{

    public function __construct()
    {
        // $this->method = 'GET';
        $this->uri = 'list';
        parent::__construct();
    }



}
