<?php

namespace App\Controller\API;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author kevinfrantz
 */
interface APIControllerInterface
{
    /**
     * @param Request $request HTTP Method GET with filtering parameters
     *
     * @return Response
     */
    public function list(Request $request): Response;
}
