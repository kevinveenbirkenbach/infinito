<?php

namespace App\Attribut;

use App\Entity\Source\Complex\FullPersonNameSourceInterface;

interface FullPersonNameSourceAttributInterface
{
    public function getFullPersonNameSource(): FullPersonNameSourceInterface;

    public function setFullPersonNameSource(FullPersonNameSourceInterface $fullname): void;
}
