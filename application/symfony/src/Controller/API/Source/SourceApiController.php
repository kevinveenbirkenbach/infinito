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
 * @see https://symfony.com/blog/new-in-symfony-4-1-prefix-imported-route-names
 * @see https://symfony.com/blog/new-in-symfony-4-1-internationalized-routing
 * @Route(
 *  {
 *      "en":"/source/{identity}.{_format}",
 *      "de":"/quelle/{identity}.{_format}",
 *      "eo":"/fonto/{identity}.{_format}",
 *      "es":"/fontanar/{identity}.{_format}",
 *      "nl":"/bron/{identity}.{_format}"
 *  },
 *  defaults={
 *      "identity"="",
 *      "_format"="json"
 *  } ,
 *  name="source_"
 * )
 */
class SourceApiController extends AbstractAPIController
{
    /**
     * @Route(
     * methods={"GET"}
     * )
     * {@inheritdoc}
     *
     * @see \Infinito\Controller\API\AbstractAPIController::read()
     */
    public function read(MVCRoutineServiceInterface $mvcRoutineService, RequestedActionServiceInterface $requestedActionService, $identity): Response
    {
        $requestedActionService->setActionType(ActionType::READ);
        $requestedActionService->setLayer(LayerType::SOURCE);
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
