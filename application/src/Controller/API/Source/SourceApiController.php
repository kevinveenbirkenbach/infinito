<?php

namespace App\Controller\API\Source;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\API\AbstractAPIController;

/**
 * @author kevinfrantz
 */
class SourceApiController extends AbstractAPIController
{
    /**
     * @Route("/api/{_locale}/source/{identifier}.{_format}",
     * defaults={"_format"="json"} ,
     * methods={"GET"}
     * )
     * {@inheritdoc}
     *
     * @see \App\Controller\API\CRUDControllerInterface::read()
     */
    public function read(Request $request, $identifier): Response
    {
    }

    /**
     * @Route("/api/{_locale}/source/.{_format}",
     * defaults={"_format"="json"} ,
     * methods={"POST"}
     * )
     * {@inheritdoc}
     *
     * @see \App\Controller\API\CRUDControllerInterface::create()
     */
    public function create(Request $request): Response
    {
    }

    /**
     * @Route("/api/{_locale}/source/{identifier}.{_format}",
     * defaults={"_format"="json"} ,
     * methods={"PUT"}
     * )
     * {@inheritdoc}
     *
     * @see \App\Controller\API\CRUDControllerInterface::update()
     */
    public function update(Request $request, $identifier): Response
    {
    }

    /**
     * @Route("/api/{_locale}/sources/.{_format}",
     * defaults={"_format"="json"} ,
     * methods={"GET"}
     * )
     * {@inheritdoc}
     *
     * @see \App\Controller\API\APIControllerInterface::list()
     */
    public function list(Request $request): Response
    {
    }

    /**
     * @Route("/api/{_locale}/source/{identifier}.{_format}",
     * defaults={"_format"="json"} ,
     * methods={"DELETE"}
     * )
     * {@inheritdoc}
     *
     * @see \App\Controller\API\CRUDControllerInterface::delete()
     */
    public function delete(Request $request, $identifier): Response
    {
    }
}
