<?php

namespace Divart\Trumpia;

use Divart\Trumpia\Common\Requests\ListRequest;
use Divart\Trumpia\Common\Requests\StatusReportRequest;

class TrumpiaRestApi
{
    public function __construct()
    {
    }

    public function list()
    {
        return new ListRequest();
    }

    public function statusReport()
    {
        return new StatusReportRequest();
    }
}
