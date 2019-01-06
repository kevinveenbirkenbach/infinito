<?php

namespace App\Controller\API\Meta;

use App\Controller\API\AbstractAPIController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Domain\SecureCRUDManagement\SecureCRUDFactoryService;

/**
 * 
 * @author kevinfrantz
 * @todo Implement!
 */
class MemberApiController extends AbstractAPIController
{
    public function read(Request $request, $identifier): Response
    {
    }

    public function create(Request $request, SecureCRUDFactoryService $crudFactory): Response
    {
    }

    public function update(Request $request, $identifier): Response
    {
    }

    public function list(Request $request): Response
    {
    }

    public function delete(Request $request, $identifier): Response
    {
    }
}
