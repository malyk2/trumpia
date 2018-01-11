<?php
namespace Divart\Trumpia\Common\Interfaces;

use Divart\Trumpia\Common\RestInterface;

class ArrayRestInterface implements RestInterface
{
    public function output($response)
    {
        return json_decode($response->getBody(), true);
    }
}