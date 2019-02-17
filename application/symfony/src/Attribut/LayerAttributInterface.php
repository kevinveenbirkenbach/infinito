<?php

namespace Infinito\Attribut;

/**
 * @author kevinfrantz
 */
interface LayerAttributInterface
{
    /**
     * @param string $layer
     */
    public function setLayer(string $layer): void;

    /**
     * @return string
     */
    public function getLayer(): string;
}
