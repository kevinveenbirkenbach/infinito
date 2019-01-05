<?php

namespace App\Domain\ResponseManagement;

use Symfony\Component\HttpFoundation\Response;

interface SourceRESTResponseManagerInterface
{
    /**
     * @return Response
     */
    public function getResponse(): Response;
}
