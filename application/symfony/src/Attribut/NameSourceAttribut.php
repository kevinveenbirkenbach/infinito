<?php

namespace Infinito\Attribut;

use Infinito\Entity\Source\Primitive\Name\NameSourceInterface;

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
        return $this->nameSource;
    }
}
