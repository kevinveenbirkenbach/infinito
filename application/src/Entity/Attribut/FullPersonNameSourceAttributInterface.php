<?php

namespace App\Entity\Attribut;

use App\Entity\Source\Combination\FullPersonNameSourceInterface;

interface FullPersonNameSourceAttributInterface
{
    public function getFullPersonNameSource(): FullPersonNameSourceInterface;

    public function setFullPersonNameSource(FullPersonNameSourceInterface $fullname): void;
}
