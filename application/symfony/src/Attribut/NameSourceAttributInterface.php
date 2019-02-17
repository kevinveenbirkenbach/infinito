<?php

namespace Infinito\Attribut;

use Infinito\Entity\Source\Primitive\Name\NameSourceInterface;

/**
 * @author kevinfrantz
 */
interface NameSourceAttributInterface
{
    public function setNameSource(NameSourceInterface $nameSource): void;

    public function getNameSource(): NameSourceInterface;
}
