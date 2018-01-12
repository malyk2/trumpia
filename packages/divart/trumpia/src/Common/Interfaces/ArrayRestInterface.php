<?php
namespace Divart\Trumpia\Common\Interfaces;

use Divart\Trumpia\Common\RestInterface;
use Divart\Trumpia\Common\RestConst;

class ArrayRestInterface implements RestInterface
{
    public function output($response)
    {
        $response = json_decode($response->getBody(), true);
        return $this->handleResponse($response);
    }

    public function handleResponse($response)
    {
        if ( ! empty(config('trumpia.handle_status_code')) && array_has($response,'status_code') ) {
            $code = $response['status_code'];
            $text = RestConst::textStatusCode($response['status_code']);
            $response['status_code_text'] = $text;
        }
        return $response;
    }
}