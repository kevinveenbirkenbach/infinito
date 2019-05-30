<?php

namespace Infinito\Domain\Parameter;

use Infinito\Domain\Parameter\Parameter\ParameterInterface;
use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 */
interface ParameterFactoryInterface
{
    /**
     * @param string $key
     *
     * @return ParameterInterface
     */
    public function getParameter(string $key): ParameterInterface;

    /**
     * @return Collection|ParameterInterface[]
     */
    public function getAllParameters(): Collection;
}
