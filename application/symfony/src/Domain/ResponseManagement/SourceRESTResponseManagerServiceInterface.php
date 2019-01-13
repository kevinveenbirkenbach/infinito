<?php

namespace App\Domain\ResponseManagement;

use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\ViewHandlerInterface;

interface SourceRESTResponseManagerServiceInterface
{
    /**
     * @return Response
     */
    public function getResponse(ViewHandlerInterface $viewHandler): Response;
}
