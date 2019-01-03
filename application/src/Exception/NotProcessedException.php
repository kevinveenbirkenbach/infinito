<?php

namespace App\Exception;

final class NotProcessedException extends \Exception
{
    public function __construct($message = null)
    {
        parent::__construct($message);
    }
}
