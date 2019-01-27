<?php

namespace App\Controller\API\Source;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\API\AbstractAPIController;

/**
 * @author kevinfrantz
 *
 * @todo Implement!
 */
class SourceApiController extends AbstractAPIController
{
    /**
     * @Route("/{_locale}/api/source/{identifier}.{_format}",
     * defaults={"_format"="json"} ,
     * methods={"GET"}
     * )
     * {@inheritdoc}
     *
     * @see \App\Controller\API\AbstractAPIController::read()
     */
    public function read(Request $request, $identifier): Response
    {
    }

    /**
     * @Route("/{_locale}/api/source/{identifier}.{_format}",
     * defaults={"_format"="json"} ,
     * methods={"PUT"}
     * )
     * {@inheritdoc}
     *
     * @see \App\Controller\API\AbstractAPIController::update()
     */
    public function update(Request $request, $identifier): Response
    {
    }

    /**
     * @Route("/{_locale}/api/sources/.{_format}",
     * defaults={"_format"="json"} ,
     * methods={"GET"}
     * )
     * {@inheritdoc}
     *
     * @see \App\Controller\API\AbstractAPIController::list()
     */
    public function list(Request $request): Response
    {
    }

    /**
     * @Route("/{_locale}/api/source/{identifier}.{_format}",
     * defaults={"_format"="json"} ,
     * methods={"DELETE"}
     * )
     * {@inheritdoc}
     *
     * @see \App\Controller\API\AbstractAPIController::delete()
     */
    public function delete(Request $request, $identifier): Response
    {
    }
}
