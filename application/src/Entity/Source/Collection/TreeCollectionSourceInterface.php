<?php

namespace App\Entity\Source\Collection;

use App\Entity\Attribut\MembersAttributInterface;
use App\Helper\DimensionHelperInterface;

/**
 * @author kevinfrantz
 */
interface TreeCollectionSourceInterface extends MembersAttributInterface, CollectionSourceInterface, DimensionHelperInterface
{
}
