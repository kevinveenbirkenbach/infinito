<?php

namespace App\Controller\API;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Moved functions to
 * @see AbstractAPIController
 * @author kevinfrantz
 * @deprecated Feel free to delete this interface!
 * @see https://de.wikipedia.org/wiki/CRUD
 */
interface CRUDControllerInterface
{
    /**
     * @param Request $request HTTP Method POST with the object attributes as parameters
     *
     * @return Response
     */
    public function create(Request $request): Response;

    /**
     * @param Request    $request    HTTP Method GET
     * @param int|string $identifier The slug or id of the object
     *
     * @return Response
     */
    public function read(Request $request, $identifier): Response;

    /**
     * @param Request    $request    HTTP Method PUT
     * @param int|string $identifier The slug or id of the object
     *
     * @return Response
     */
    public function update(Request $request, $identifier): Response;

    /**
     * @param Request    $request    HTTP Method DELETE with the object attributes as parameters
     * @param int|string $identifier The slug or id of the object
     *
     * @return Response
     */
    public function delete(Request $request, $identifier): Response;
}
