<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\AbstractSource;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Source\TemplateGenerator;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author kevinfrantz
 */
class SourceController extends AbstractController
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
        $templateGenerator = new TemplateGenerator($source, $request);

        return $this->render($templateGenerator->getTemplatePath(), ['source' => $source]);
    }
}
