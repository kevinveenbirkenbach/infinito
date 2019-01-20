<?php

namespace App\Attribut;

use App\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
interface SourceAttributInterface
{
    public function getSource(): SourceInterface;

    public function setSource(SourceInterface $source): void;
}
