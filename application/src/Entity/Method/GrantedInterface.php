<?php

namespace App\Entity\Method;

use App\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
interface GrantedInterface
{
    /**
     * Returns true if the source is granted access to the layer with the requested right.
     * @param SourceInterface $source
     * @param string $right
     * @return bool
     */
    public function isGranted(SourceInterface $source, string $layer, string $right): bool;
}
