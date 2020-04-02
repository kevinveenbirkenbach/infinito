<?php

namespace Infinito\Domain\Parameter;

use Doctrine\Common\Collections\Collection;
use Infinito\Domain\Parameter\Parameter\ParameterInterface;

/**
 * @author kevinfrantz
 */
interface ParameterFactoryInterface
{
    public function getParameter(string $key): ParameterInterface;

    /**
     * @return Collection|ParameterInterface[]
     */
    public function getAllParameters(): Collection;
}
