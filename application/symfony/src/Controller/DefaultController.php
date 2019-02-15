<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Domain\MVCManagement\MVCRoutineServiceInterface;
use App\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use App\DBAL\Types\ActionType;
use App\Domain\FixtureManagement\FixtureSource\ImpressumFixtureSource;

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
        $requestedActionService->getRequestedEntity()->setSlug(ImpressumFixtureSource::SLUG);
        $view = $mvcRoutineService->process();
        $this->handleView($view);
    }

    /**
     * @Route("/", name="homepage")
     */
    public function homepage(): Response
    {
        return $this->render('standard/homepage.html.twig');
    }
}
