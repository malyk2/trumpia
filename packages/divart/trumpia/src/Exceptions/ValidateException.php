<?php

namespace Divart\Trumpia\Exceptions;

use Exception;
use Illuminate\Support\MessageBag;

class ValidateException extends Exception
{
    private $messageBug;

    public function __construct(MessageBag $messageBug)
    {
        $this->messageBug = $messageBug;
    }

    public function render()
    {
        throw(new Exception($this->errorMessage()));
    }

    public function errorMessage()
    {
        return 'Validate error. '. $this->messageBug->first();
    }
}
