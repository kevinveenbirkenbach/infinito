<?php

namespace App\Attribut;

use Symfony\Component\HttpFoundation\Request;

/**
 * @author kevinfrantz
 */
interface RequestAttributInterface
{
    /**
     * @param Request $request
     */
    public function setRequest(Request $request): void;

    /**
     * @return Request
     */
    public function getRequest(): Request;
}
