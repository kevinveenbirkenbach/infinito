<?php

namespace Infinito\Entity\Meta\History;

use Infinito\Entity\Meta\AbstractMeta;
use Infinito\Attribut\LogsAttribut;

/**
 * @author kevinfrantz
 */
final class Journal extends AbstractMeta implements JournalInterface
{
    use LogsAttribut;
}
