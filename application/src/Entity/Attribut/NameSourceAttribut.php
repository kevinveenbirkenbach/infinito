<?php

namespace App\Entity\Attribut;

use App\Entity\NameSourceInterface;

/**
 * @author kevinfrantz
 */
trait NameSourceAttribut
{
    /**
     * @var NameSourceInterface
     */
    protected $nameSource;

    public function setNameSource(NameSourceInterface $nameSource): void
    {
        $this->nameSource = $nameSource;
    }

    public function getNameSource(): NameSourceInterface
    {
        return $this->getNameSource();
    }
}
