<?php

namespace App\Entity\Attribut\Interfaces;

use App\Entity\Interfaces\NameSourceInterface;

/**
 * @author kevinfrantz
 */
interface NameSourceAttributInterface
{
    public function setNameSource(NameSourceInterface $nameSource): void;

    public function getNameSource(): NameSourceInterface;
}
