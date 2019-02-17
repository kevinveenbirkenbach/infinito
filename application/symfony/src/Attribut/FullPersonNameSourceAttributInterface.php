<?php

namespace Infinito\Attribut;

use Infinito\Entity\Source\Complex\FullPersonNameSourceInterface;

interface FullPersonNameSourceAttributInterface
{
    public function getFullPersonNameSource(): FullPersonNameSourceInterface;

    public function setFullPersonNameSource(FullPersonNameSourceInterface $fullname): void;
}
