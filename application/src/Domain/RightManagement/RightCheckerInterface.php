<?php

namespace App\Domain\RightManagement;

use App\Entity\Source\SourceInterface;

interface RightCheckerInterface
{
    public function isGranted(string $layer, string $type, SourceInterface $source): bool;
}
