<?php

namespace App\Entity\Attribut;

use App\Entity\Source\Data\Name\SurnameSourceInterface;

interface SurnameSourceAttributInterface
{
    public function getSurname(): SurnameSourceInterface;

    public function setSurname(SurnameSourceInterface $name): void;
}
