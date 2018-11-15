<?php

namespace App\Entity\Attribut;

use App\Entity\Source\Data\PersonIdentitySourceInterface;

trait PersonIdentitySourceAttribut
{
    /**
     * @var PersonIdentitySourceInterface
     */
    protected $personIdentitySource;

    public function getPersonIdentitySource(): PersonIdentitySourceInterface
    {
        return $this->personIdentitySource;
    }

    public function setPersonIdentitySource(PersonIdentitySourceInterface $identity): void
    {
        $this->personIdentitySource = $identity;
    }
}
