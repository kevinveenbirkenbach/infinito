<?php

namespace Infinito\Domain\Parameter\Parameter;

/**
 * @author kevinfrantz
 */
interface ParameterInterface
{
    /**
     * @param mixed $value
     */
    public function setValue($value): void;

    /**
     * @return mixed The value
     */
    public function getValue();
}
