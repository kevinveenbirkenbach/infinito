<?php

namespace App\Entity\Meta\Relation;

use App\Entity\Meta\AbstractMeta;

/**
 * @author kevinfrantz
 */
abstract class AbstractRelation extends AbstractMeta implements RelationInterface
{
    public function __construct()
    {
        parent::__construct();
    }
}
