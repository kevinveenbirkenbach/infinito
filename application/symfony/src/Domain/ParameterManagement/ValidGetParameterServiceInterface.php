<?php

namespace Infinito\Domain\ParameterManagement;

/**
 * @author kevinfrantz
 */
interface ValidGetParameterServiceInterface extends OptionalGetParameterServiceInterface
{
    /**
     * @param string $key
     *
     * @return bool checks if the parameter is valid
     */
    public function isValid(string $key): bool;
}
