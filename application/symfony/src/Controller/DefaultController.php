<?php

namespace Infinito\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Infinito\Domain\MVCManagement\MVCRoutineServiceInterface;
use Infinito\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Infinito\DBAL\Types\ActionType;
use Infinito\Domain\FixtureManagement\FixtureSource\ImpressumFixtureSource;
use Infinito\DBAL\Types\Meta\Right\LayerType;

/**
 * This controller offers the standart routes for the template.
 *
 * @author kevinfrantz
 */
final class DefaultController extends AbstractController
{
    /**
     * @deprecated Use load via source instead of fixed route
     *
     * @todo Optimize function!
     * @Route("/imprint.{_format}", defaults={"_format"="json"}, name="imprint")
     */
    public function imprint(MVCRoutineServiceInterface $mvcRoutineService, RequestedActionServiceInterface $requestedActionService): Response
    {
        $requestedActionService->setActionType(ActionType::READ);
        $requestedActionService->setLayer(LayerType::SOURCE);
        $requestedActionService->getRequestedEntity()->setSlug(ImpressumFixtureSource::SLUG);
        $view = $mvcRoutineService->process();

        return $this->handleView($view);
    }

    /**
     * @Route("/", name="homepage")
     */
    public function homepage(): Response
    {
        return $this->render('standard/homepage.html.twig');
    }
}
