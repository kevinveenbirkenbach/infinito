<?php

namespace App\Entity\Method;

use Doctrine\Common\Collections\Collection;
use App\Helper\DimensionHelper;
use App\Entity\Attribut\MembersAttributInterface;

/**
 * @todo Create test for trait!
 *
 * @author kevinfrantz
 */
trait CollectionDimensionHelperMethod
{
    public function getDimensions(?int $dimension = null, Collection $elements = null): Collection
    {
        $dimensionHelper = new DimensionHelper(__FUNCTION__, MembersAttributInterface::class, $this, 'collection');

        return $dimensionHelper->getDimensions($dimension, $elements);
    }
}
