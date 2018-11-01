<?php
namespace App\Helper;

use Doctrine\Common\Collections\Collection;

interface DimensionInterface
{
    public function getDimensions(?int $dimension = null, Collection $elements = null): Collection;
}

