<?php

namespace App\Entity\Attribut;

use App\Entity\Source\Combination\PersonIdentitySourceInterface;

interface PersonIdentitySourceAttributInterface
{
    public function getPersonIdentitySource(): PersonIdentitySourceInterface;

    public function setPersonIdentitySource(PersonIdentitySourceInterface $identity): void;
}
