<?php

namespace App\Domain\LayerManagement;

/**
 * @author kevinfrantz
 */
interface LayerClassMapInterface
{
    /**
     * @param string $layer
     *
     * @return string The class which belongs to an Layer
     */
    public static function getClass(string $layer): string;
}
