<?php

namespace App\Entity\Attribut;

use App\Entity\NameSourceInterface;

/**
 * @author kevinfrantz
 */
interface NameSourceAttributInterface
{
    public function setNameSource(NameSourceInterface $nameSource): void;

    public function getNameSource(): NameSourceInterface;
}
