<?php

namespace App\Attribut;

use App\Entity\Source\Primitive\Name\SurnameSourceInterface;

interface SurnameSourceAttributInterface
{
    public function getSurnameSource(): SurnameSourceInterface;

    public function setSurnameSource(SurnameSourceInterface $name): void;
}
