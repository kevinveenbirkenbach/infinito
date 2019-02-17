<?php

namespace Infinito\Attribut;

use Infinito\Entity\Meta\RightInterface;

/**
 * @author kevinfrantz
 */
interface RightAttributInterface
{
    public function setRight(RightInterface $right): void;

    public function getRight(): RightInterface;
}
