<?php

namespace Infinito\Attribut;

use Infinito\Entity\Source\Primitive\Name\SurnameSourceInterface;

interface SurnameSourceAttributInterface
{
    public function getSurnameSource(): SurnameSourceInterface;

    public function setSurnameSource(SurnameSourceInterface $name): void;
}
