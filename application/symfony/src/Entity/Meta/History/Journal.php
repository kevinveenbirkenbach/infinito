<?php

namespace Infinito\Entity\Meta\History;

use Infinito\Attribut\LogsAttribut;
use Infinito\Entity\Meta\AbstractMeta;

/**
 * @author kevinfrantz
 */
final class Journal extends AbstractMeta implements JournalInterface
{
    use LogsAttribut;
}
