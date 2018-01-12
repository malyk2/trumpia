<?php
namespace Divart\Trumpia\Common;

interface RestInterface
{
    public function output($response);

    public function handleResponse($response);
}