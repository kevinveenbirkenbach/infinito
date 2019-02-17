<?php

namespace Infinito\Attribut;

use Infinito\Entity\Source\Complex\PersonIdentitySourceInterface;

interface PersonIdentitySourceAttributInterface
{
    public function getPersonIdentitySource(): PersonIdentitySourceInterface;

    public function setPersonIdentitySource(PersonIdentitySourceInterface $identity): void;
}
