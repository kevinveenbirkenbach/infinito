<?php

namespace App\Entity\Attribut;

use App\Entity\Source\Data\Name\SurnameSourceInterface;

trait SurnameSourceAttribut
{
    /**
     * @var SurnameSourceInterface
     */
    protected $surnameSource;

    public function getSurnameSource(): SurnameSourceInterface
    {
        return $this->surnameSource;
    }

    public function setSurnameSource(SurnameSourceInterface $name): void
    {
        $this->surnameSource = $name;
    }
}
