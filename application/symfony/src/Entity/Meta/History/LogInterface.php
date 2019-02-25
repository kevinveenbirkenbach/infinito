<?php

namespace Infinito\Entity\Meta\History;

use Infinito\Entity\EntityInterface;
use Infinito\Attribut\ActionTypeAttributInterface;
use Infinito\Attribut\RecieverAttributInterface;
use Infinito\Attribut\SourceAttributInterface;
use Infinito\Attribut\TimestampAttributInterface;

/**
 * Containes a log entry to every request wich is handled by infinito.
 *
 * @author kevinfrantz
 */
interface LogInterface extends EntityInterface, ActionTypeAttributInterface, RecieverAttributInterface, SourceAttributInterface, TimestampAttributInterface
{
}
