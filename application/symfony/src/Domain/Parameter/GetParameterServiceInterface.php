<?php

namespace Infinito\Domain\Parameter;

/**
 * This interface offers a service to manage all optional get parameters.
 *
 * @author kevinfrantz
 */
interface GetParameterServiceInterface
{
    /**
     * @return bool True if the version parameter in the request is set
     */
    public function hasParameter(string $key): bool;

    /**
     * @return mixed
     */
    public function getParameter(string $key);
}
