<?php

namespace Infinito\Controller\API\Rest;

use Infinito\Attribut\ClassAttributInterface;
use Infinito\Controller\API\AbstractAPIController;
use Infinito\DBAL\Types\ActionType;
use Infinito\Domain\Core\CoreServiceInterface;
use Infinito\Domain\Request\Action\RequestedActionServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @var string
     */
    public const IDENTITY_PARAMETER_KEY = 'identity';

    /**
     * @var string
     */
    public const LAYER_PARAMETER_KEY = 'layer';

    /**
     * @var string
     */
    public const LAYER_GET_ROUTE = 'infinito_api_rest_layer_read';

    /**
     * @var string
     */
    public const LAYER_CREATE_ROUTE = 'infinito_api_rest_layer_create';

    /**
     * @Route(
     * ".{_format}",
     * methods={"GET","POST"}
     * )
     *
     * @todo Mayber create an own controller for sources, because they have some special logic!
     */
    public function create(Request $request, CoreServiceInterface $coreService, RequestedActionServiceInterface $requestedActionService, string $layer): Response
    {
        //Not implemented yet in Core routine. This is just a draft!
        if ($request->query->has(ClassAttributInterface::CLASS_ATTRIBUT_NAME)) {
            $class = $request->query->get(ClassAttributInterface::CLASS_ATTRIBUT_NAME);
            $requestedActionService->getRequestedEntity()->setClass($class);
        }
        $requestedActionService->setActionType(ActionType::CREATE);
        $requestedActionService->setLayer($layer);
        $view = $coreService->process();

        return $this->handleView($view);
    }

    /**
     * @Route(
     * "/{identity}.{_format}",
     * methods={"GET"}
     * )
     */
    public function read(CoreServiceInterface $coreService, RequestedActionServiceInterface $requestedActionService, string $layer, $identity): Response
    {
        $requestedActionService->setActionType(ActionType::READ);
        $requestedActionService->setLayer($layer);
        $requestedActionService->getRequestedEntity()->setIdentity($identity);
        $view = $coreService->process();

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
