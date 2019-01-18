<?php

namespace App\Domain\RightManagement;

use App\Entity\Source\SourceInterface;

/**
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
