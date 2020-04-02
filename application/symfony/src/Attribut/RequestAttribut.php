<?php

namespace Infinito\Attribut;

use Symfony\Component\HttpFoundation\Request;

/**
 * @author kevinfrantz
 *
 * @see RequestAttributInterface
 */
trait RequestAttribut
{
    /**
     * @var Request
     */
    protected $request;

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}
