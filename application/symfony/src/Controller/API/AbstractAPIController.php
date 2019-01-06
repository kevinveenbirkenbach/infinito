<?php

namespace App\Controller\API;

use App\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author kevinfrantz
 * @see https://de.wikipedia.org/wiki/CRUD
 */
abstract class AbstractAPIController extends AbstractController implements APIControllerInterface
{

    /**
     * @param Request $request HTTP Method POST with the object attributes as parameters
     *
     * @return Response
     */
    abstract public function create(Request $request): Response;
    
    /**
     * @param Request    $request    HTTP Method GET
     * @param int|string $identifier The slug or id of the object
     *
     * @return Response
     */
    abstract public function read(Request $request, $identifier): Response;
    
    /**
     * @param Request    $request    HTTP Method PUT
     * @param int|string $identifier The slug or id of the object
     *
     * @return Response
     */
    abstract public function update(Request $request, $identifier): Response;
    
    /**
     * @param Request    $request    HTTP Method DELETE with the object attributes as parameters
     * @param int|string $identifier The slug or id of the object
     *
     * @return Response
     */
    abstract public function delete(Request $request, $identifier): Response;
}