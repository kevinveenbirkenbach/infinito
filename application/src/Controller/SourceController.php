<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\AbstractSource;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Creator\Factory\Template\Source\SourceTemplateFactory;
use FOS\RestBundle\Controller\FOSRestController;
use App\Form\NameSourceType;
use App\Entity\SourceInterface;
use App\Creator\Factory\Template\Source\SourceTemplateFormFactory;
use App\Creator\Factory\Form\Source\SourceFormFactory;

/**
 * @todo IMPLEMENT SECURITY!
 * @author kevinfrantz
 */
class SourceController extends FOSRestController
{

    public function modify(int $id): Response
    {}

    /**
     *
     * @Route("/source/{id}.{_format}", defaults={"_format"="html"})
     */
    public function show(Request $request, int $id): Response
    {
        $source = $this->loadSource($request, $id);
        $view = $this->view($source, 200)
            ->setTemplate((new SourceTemplateFactory($source, $request))->getTemplatePath())
            ->setTemplateVar('source');
        return $this->handleView($view);
    }

    /**
     *
     * @Route("/source/{id}.{_format}/edit", defaults={"_format"="html"})
     */
    public function edit(Request $request, int $id): Response
    {
        $source = $this->loadSource($request, $id);
        $form = $this->createForm((new SourceFormFactory($source))->getNamespace(), $source);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $source = $form->getData();
            $this->saveSource($source);
        }
        return $this->render((new SourceTemplateFormFactory($source, $request))->getTemplatePath(), array(
            'form' => $form->createView(),
        ));
    }

    private function loadSource(Request $request, int $id): SourceInterface
    {
        $source = $this->getDoctrine()
            ->getRepository(AbstractSource::class)
            ->find($id);
        if (! $source) {
            throw $this->createNotFoundException('No source found for id ' . $id);
        }
        return $source;
    }

    private function saveSource(SourceInterface $source): void
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($source);
        $entityManager->flush();
    }
}
