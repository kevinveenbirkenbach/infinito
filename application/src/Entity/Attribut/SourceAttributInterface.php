<?php

namespace App\Entity\Attribut\Interfaces;

use App\Entity\SourceInterface;

/**
 * @author kevinfrantz
 */
interface SourceAttributInterface
{
    public function getSource(): SourceInterface;

    public function setSource(SourceInterface $source): void;
}
