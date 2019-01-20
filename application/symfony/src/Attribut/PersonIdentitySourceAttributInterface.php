<?php

namespace App\Attribut;

use App\Entity\Source\Complex\PersonIdentitySourceInterface;

interface PersonIdentitySourceAttributInterface
{
    public function getPersonIdentitySource(): PersonIdentitySourceInterface;

    public function setPersonIdentitySource(PersonIdentitySourceInterface $identity): void;
}
