<?php

namespace Infinito\Domain\Right;

use Infinito\Entity\Source\SourceInterface;

/**
 * Checks if the crud, layer and source combination is granted by a right.
 *
 * @author kevinfrantz
 */
interface RightCheckerInterface
{
    /**
     * @param string          $layer
     * @param string          $type
     * @param SourceInterface $source
     *
     * @return bool
     */
    public function isGranted(string $layer, string $type, SourceInterface $source): bool;
}
