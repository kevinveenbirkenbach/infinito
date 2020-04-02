<?php

namespace Infinito\Attribut;

use Symfony\Component\HttpFoundation\Request;

/**
 * @author kevinfrantz
 */
interface RequestAttributInterface
{
    public function setRequest(Request $request): void;

    public function getRequest(): Request;
}
