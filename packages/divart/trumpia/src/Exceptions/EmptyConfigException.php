<?php

namespace Divart\Trumpia\Exceptions;

use Exception;

class EmptyConfigException extends Exception
{
    // public function render
    public function __construct($message = '')
    {
        parent::__construct($message);
    }

    /**
     * prints error message
     *
     * @return string
     */
    public function errorMessage()
    {
        $errorMsg = 'Error on line ' . $this->getLine() . ' in ' . $this->getFile()
            . ': <b>' . $this->getMessage() . '</b>';
        return $errorMsg;
    }
}
