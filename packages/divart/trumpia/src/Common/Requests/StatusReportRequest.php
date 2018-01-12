<?php
namespace Divart\Trumpia\Common\Requests;

use Divart\Trumpia\Common\RestRequest;

class StatusReportRequest extends RestRequest
{

    public function __construct()
    {
        $this->uri = 'report';

        $this->params = [
            'GET' => [],
        ];

        parent::__construct();
    }



}
