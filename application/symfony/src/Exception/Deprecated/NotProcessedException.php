<?php

namespace Infinito\Exception\Deprecated;

/**
 * @author kevinfrantz
 *
 * @deprecated
 */
final class NotProcessedException extends \Exception
{
    public function __construct($message = null)
    {
        parent::__construct($message);
    }
}
