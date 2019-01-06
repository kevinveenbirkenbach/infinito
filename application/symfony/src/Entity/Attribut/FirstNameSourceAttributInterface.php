<?php

namespace App\Entity\Attribut;

use App\Entity\Source\Primitive\Name\FirstNameSourceInterface;

interface FirstNameSourceAttributInterface
{
    public function getFirstNameSource(): FirstNameSourceInterface;

    public function setFirstNameSource(FirstNameSourceInterface $name): void;
}