<?php

namespace App\Entity\Meta;

use App\Entity\Attribut\RightsAttributInterface;
use App\Entity\Attribut\RelationAttributInterface;
use App\Entity\Method\RelationGrantedInterface;

/**
 * @author kevinfrantz
 */
interface LawInterface extends RightsAttributInterface, RelationGrantedInterface, MetaInterface
{
}
