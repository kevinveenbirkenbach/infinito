<?php

namespace App\Entity\Attribut;

/**
 * @author kevinfrantz
 */
trait LayerAttribut
{
    /**
     * @var string
     */
    protected $layer;

    public function setLayer(string $layer): void
    {
        $this->layer = $layer;
    }

    public function getLayer(): string
    {
        return $this->layer;
    }
}
