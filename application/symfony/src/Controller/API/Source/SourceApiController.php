<?php

namespace Infinito\Controller\API\Source;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Infinito\Controller\API\AbstractAPIController;
use Infinito\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Infinito\Domain\MVCManagement\MVCRoutineServiceInterface;
use Infinito\DBAL\Types\ActionType;
use Infinito\DBAL\Types\Meta\Right\LayerType;

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
     * @see \Infinito\Controller\API\AbstractAPIController::read()
     */
    public function read(MVCRoutineServiceInterface $mvcRoutineService, RequestedActionServiceInterface $requestedActionService, $identifier): Response
    {
        $requestedActionService->setActionType(ActionType::READ);
        $requestedActionService->setLayer(LayerType::SOURCE);
        $requestedActionService->getRequestedEntity()->setIdentity($identifier);
        $view = $mvcRoutineService->process();

        return $this->handleView($view);
    }

    /**
     * @Route("/{_locale}/api/source/{identifier}.{_format}",
     * defaults={"_format"="json"} ,
     * methods={"PUT"}
     * )
     * {@inheritdoc}
     *
     * @see \Infinito\Controller\API\AbstractAPIController::update()
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
     * @see \Infinito\Controller\API\AbstractAPIController::list()
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
     * @see \Infinito\Controller\API\AbstractAPIController::delete()
     */
    public function delete(Request $request, $identifier): Response
    {
    }
}
