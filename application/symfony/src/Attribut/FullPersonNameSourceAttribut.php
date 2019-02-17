<?php

namespace Infinito\Attribut;

use Infinito\Entity\Source\Complex\FullPersonNameSourceInterface;

trait FullPersonNameSourceAttribut
{
    /**
     * @var FullPersonNameSourceInterface
     */
    protected $fullPersonNameSource;

    public function getFullPersonNameSource(): FullPersonNameSourceInterface
    {
        return $this->fullPersonNameSource;
    }

    public function setFullPersonNameSource(FullPersonNameSourceInterface $fullname): void
    {
        $this->fullPersonNameSource = $fullname;
    }
}
