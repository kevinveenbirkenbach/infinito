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
    public function isGranted(string $layer, string $type, SourceInterface $source): bool;
}
