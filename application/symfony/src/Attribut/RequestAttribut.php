<?php

namespace App\Attribut;

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

    /**
     * @param Request $request
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }
}
