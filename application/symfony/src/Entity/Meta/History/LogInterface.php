<?php

namespace Infinito\Entity\Meta\History;

use Infinito\Attribut\ActionTypeAttributInterface;
use Infinito\Attribut\RecieverAttributInterface;
use Infinito\Attribut\SourceAttributInterface;
use Infinito\Attribut\TimestampAttributInterface;
use Infinito\Entity\EntityInterface;

/**
 * Containes a log entry to every request wich is handled by infinito.
 *
 * @author kevinfrantz
 */
interface LogInterface extends EntityInterface, ActionTypeAttributInterface, RecieverAttributInterface, SourceAttributInterface, TimestampAttributInterface
{
}
