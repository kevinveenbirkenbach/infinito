<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\AbstractSource;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Source\Generator\StringGenerator;
use FOS\RestBundle\FOSRestBundle;
use App\Creator\Factory\Template\SourceTemplateFactory;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;

/**
 * @author kevinfrantz
 */
class SourceController extends FOSRestController
{
    public function modify(int $id): Response
    {
    }

    /**
     * @Route("/source/{id}.{_format}", defaults={"_format"="html"})
     */
    public function show(Request $request, int $id): Response
    {
        $source = $this->getDoctrine()
            ->getRepository(AbstractSource::class)
            ->find($id);
        if (!$source) {
            throw $this->createNotFoundException('No source found for id '.$id);
        }
        $view = $this->view($source, 200)
        ->setTemplate((new SourceTemplateFactory($source, $request))->getTemplatePath())
        ->setTemplateVar('source');
        return $this->handleView($view);
    }
}
