<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\DBAL\Types\SystemSlugType;
use App\Entity\Source\AbstractSource;

/**
 * This controller offers the standart routes for the template.
 *
 * @author kevinfrantz
 */
class DefaultController extends AbstractEntityController
{
    /**
     * @todo Optimize function!
     * @Route("/imprint", name="imprint")
     */
    public function imprint(): Response
    {
        $source = $this->loadEntityBySlug(SystemSlugType::IMPRINT);
        $view = $this->view($source, 200)
        ->setTemplate('standard/imprint.html.twig')
        ->setTemplateVar('source');

        return $this->handleView($view);
    }

    /**
     * @Route("/", name="homepage")
     */
    public function homepage(): Response
    {
        return $this->render('standard/homepage.html.twig');
    }

    protected function setEntityName(): void
    {
        $this->entityName = AbstractSource::class;
    }
}
