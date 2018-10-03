<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Creator\Factory\Template\Source\SourceTemplateFactory;
use FOS\RestBundle\Controller\FOSRestController;
use App\Entity\Source\SourceInterface;
use App\Creator\Factory\Template\Source\SourceTemplateFormFactory;
use App\Creator\Factory\Form\Source\SourceFormFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @todo IMPLEMENT SECURITY!
 *
 * @author kevinfrantz
 */
class SourceController extends FOSRestController
{
    /**
     * @Route("/source/{id}.{_format}", defaults={"_format"="html"})
     */
    public function show(Request $request, int $id): Response
    {
        $source = $this->loadSource($request, $id);
        $assembler = $this->get(SourceDTOAssember::class);
        $dto = $assembler->build($source, $this->getUser());
        $view = $this->view($source, 200)
            ->setTemplate((new SourceTemplateFactory($source, $request))->getTemplatePath())
            ->setTemplateVar('source');

        return $this->handleView($view);
    }

    /**
     * @Route("/source/{id}/edit.{_format}", defaults={"_format"="html"})
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

        return $this->render((new SourceTemplateFormFactory($source, $request))->getTemplatePath(), [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/source/{id}/node.{_format}", defaults={"_format"="html"})
     */
    public function node(Request $request, int $id): RedirectResponse
    {
        $source = $this->loadSource($request, $id);

        return $this->redirectToRoute('app_node_show', ['id' => $source->getNode()->getId()]);
    }

    private function loadSource(Request $request, int $id): SourceInterface
    {
        $source = $this->getDoctrine()
            ->getRepository(AbstractSource::class)
            ->find($id);
        if (!$source) {
            throw $this->createNotFoundException('No source found for id '.$id);
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
