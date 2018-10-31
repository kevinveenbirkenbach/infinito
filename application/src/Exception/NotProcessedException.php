<?php

namespace App\Exception;

class NotProcessedException extends \Exception
{
    public function __construct($message = null)
    {
        parent::__construct($message);
    }
}
