<?php

namespace App\Exception;

class NotDefinedException extends \Exception
{
    public function __construct($message = null)
    {
        parent::__construct($message);
    }
}
