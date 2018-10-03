<?php

namespace App\Entity\Attribut\Interfaces;

use App\Entity\RightInterface;

/**
 * @author kevinfrantz
 */
interface RightAttributInterface
{
    public function setRight(RightInterface $right): void;

    public function getRight(): RightInterface;
}
