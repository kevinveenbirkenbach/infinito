<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\DBAL\Types\SystemSlugType;
use App\Entity\Meta\Right;
use App\DBAL\Types\Meta\Right\LayerType;
use App\DBAL\Types\Meta\Right\CRUDType;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Source\PureSource;
use App\Domain\ResponseManagement\SourceRESTResponseManager;

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
    public function imprint(EntityManagerInterface $entityManager): Response
    {
        $requestedSource = new PureSource();
        $requestedSource->setSlug(SystemSlugType::IMPRINT);
        $requestedRight = new Right();
        $requestedRight->setSource($requestedSource);
        $requestedRight->setLayer(LayerType::SOURCE);
        $requestedRight->setCrud(CRUDType::READ);
        $sourceResponseManager = new SourceRESTResponseManager($this->getUser(), $entityManager, $requestedRight, $this->getViewHandler());

        return $sourceResponseManager->getResponse();
    }

    /**
     * @Route("/", name="homepage")
     */
    public function homepage(): Response
    {
        return $this->render('standard/homepage.html.twig');
    }
}
