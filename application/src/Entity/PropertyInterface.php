<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author kevinfrantz
 */
interface PropertyInterface
{
    public function isLegitimated(SourceInterface $source): bool;

    public function getLegitimated(): ArrayCollection;
}
