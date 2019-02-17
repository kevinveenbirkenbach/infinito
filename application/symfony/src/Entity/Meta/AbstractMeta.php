<?php

namespace Infinito\Entity\Meta;

use Infinito\Entity\AbstractEntity;
use Infinito\Attribut\SourceAttribut;

/**
 * @todo Implement source attribut
 *
 * @author kevinfrantz
 */
abstract class AbstractMeta extends AbstractEntity implements MetaInterface
{
    use SourceAttribut;

    public function __construct()
    {
        parent::__construct();
    }
}
