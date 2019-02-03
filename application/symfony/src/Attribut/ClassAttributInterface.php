<?php

namespace App\Attribut;

/**
 * @author kevinfrantz
 */
interface ClassAttributInterface
{
    /**
     * @param string $class
     */
    public function setClass(string $class): void;

    /**
     * @return string
     */
    public function getClass(): string;
}
