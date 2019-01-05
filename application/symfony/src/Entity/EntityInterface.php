<?php

namespace App\Entity;

use App\Entity\Attribut\VersionAttributInterface;
use App\Entity\Attribut\IdAttributInterface;

/**
 * @author kevinfrantz
 */
interface EntityInterface extends VersionAttributInterface, IdAttributInterface
{
    /**
     * Allows easier debuging.
     *
     * @return string
     */
    public function __toString(): string;
}
