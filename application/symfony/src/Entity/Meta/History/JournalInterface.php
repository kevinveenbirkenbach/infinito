<?php

namespace Infinito\Entity\Meta\History;

use Infinito\Attribut\LogsAttributInterface;
use Infinito\Entity\Meta\MetaInterface;

/**
 * Containes the logs with the action which are comited to a source.
 *
 * @author kevinfrantz
 */
interface JournalInterface extends LogsAttributInterface, MetaInterface
{
}
