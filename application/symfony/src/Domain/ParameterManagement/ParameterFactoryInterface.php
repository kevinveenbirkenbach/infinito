<?php

namespace Infinito\Domain\ParameterManagement;

use Infinito\Domain\ParameterManagement\Parameter\ParameterInterface;
use Doctrine\Common\Collections\Collection;

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
