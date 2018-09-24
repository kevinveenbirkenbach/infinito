<?php

namespace App\Entity\Attribut\Interfaces;

/**
 * @author kevinfrantz
 */
interface ParentAttributInterface
{
    public function setParent(ParentAttributInterface $parent): void;

    public function getParent(): ParentAttributInterface;
}
