<?php

namespace Infinito\Attribut;

use Infinito\Entity\Source\Complex\PersonIdentitySourceInterface;

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
