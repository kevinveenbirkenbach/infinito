<?php

namespace Infinito\Controller\API\Rest;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Infinito\Controller\API\AbstractAPIController;
use Infinito\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Infinito\Domain\MVCManagement\MVCRoutineServiceInterface;
use Infinito\DBAL\Types\ActionType;

/**
 * @author kevinfrantz
 *
 * @see https://symfony.com/blog/new-in-symfony-4-1-prefix-imported-route-names
 * @see https://symfony.com/blog/new-in-symfony-4-1-internationalized-routing
 * @Route(
 * "/api/rest/{layer}",
 *  defaults={
 *      "identity"="",
 *      "_format"="json"
 *  }
 * )
 */
final class LayerController extends AbstractAPIController
{
    /**
     * @Route(
     * ".{_format}",
     * methods={"GET","POST"}
     * )
     * {@inheritdoc}
     *
     * @see \Infinito\Controller\API\AbstractAPIController::read()
     */
    public function create(MVCRoutineServiceInterface $mvcRoutineService, RequestedActionServiceInterface $requestedActionService, string $layer, $identity): Response
    {
        $requestedActionService->setActionType(ActionType::CREATE);
        $requestedActionService->setLayer($layer);
        $view = $mvcRoutineService->process();

        return $this->handleView($view);
    }

    /**
     * @Route(
     * "/{identity}.{_format}",
     * methods={"GET"}
     * )
     * {@inheritdoc}
     *
     * @see \Infinito\Controller\API\AbstractAPIController::read()
     */
    public function read(MVCRoutineServiceInterface $mvcRoutineService, RequestedActionServiceInterface $requestedActionService, string $layer, $identity): Response
    {
        $requestedActionService->setActionType(ActionType::READ);
        $requestedActionService->setLayer($layer);
        $requestedActionService->getRequestedEntity()->setIdentity($identity);
        $view = $mvcRoutineService->process();

        return $this->handleView($view);
    }

    /**
     *@Route(
     * methods={"PUT"}
     * )
     *
     * {@inheritdoc}
     *
     * @see \Infinito\Controller\API\AbstractAPIController::update()
     */
    public function update(Request $request, $identifier): Response
    {
    }

    /**
     * @Route(
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
