<?php

namespace App\Entity\Attribut;

use App\Entity\Source\Data\Name\SurnameSourceInterface;

trait SurnameSourceAttribut
{
    /**
     * @var SurnameSourceInterface
     */
    protected $surnameSource;

    public function getSurname(): SurnameSourceInterface
    {
        return $this->surnameSource;
    }

    public function setSurname(SurnameSourceInterface $name): void
    {
        $this->surnameSource = $name;
    }
}
