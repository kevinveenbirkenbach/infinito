<?php

namespace Infinito\Attribut;

/**
 * @author kevinfrantz
 */
interface LayerAttributInterface
{
    public function setLayer(string $layer): void;

    public function getLayer(): string;
}
