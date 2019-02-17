<?php

namespace Infinito\Attribut;

/**
 * @author kevinfrantz
 */
interface ClassAttributInterface
{
    const CLASS_ATTRIBUT_NAME = 'class';

    /**
     * @param string $class
     */
    public function setClass(string $class): void;

    /**
     * @return string
     */
    public function getClass(): string;

    /**
     * @return bool True if class is defined
     */
    public function hasClass(): bool;
}
