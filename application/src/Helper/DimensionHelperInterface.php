<?php

namespace App\Helper;

use Doctrine\Common\Collections\Collection;

/**
 * @deprecated
 *
 * @author kevinfrantz
 */
interface DimensionHelperInterface
{
    /**
     * @deprecated
     *
     * @param int        $dimension
     * @param Collection $elements
     *
     * @return Collection
     */
    public function getDimensions(?int $dimension = null, Collection $elements = null): Collection;
}
