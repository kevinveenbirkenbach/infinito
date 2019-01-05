<?php

namespace App\Entity\Meta;

use App\Entity\AbstractEntity;
use App\Entity\Attribut\SourceAttribut;

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
