<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\NodeInterface;
use App\Entity\Node;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @todo IMPLEMENT SECURITY!
 *
 * @author kevinfrantz
 */
class NodeController extends AbstractEntityController
{
    /**
     * @Route("/node/{id}.{_format}", defaults={"_format"="html"})
     */
    public function show(Request $request, int $id): Response
    {
        /**
         * @var NodeInterface $node
         */
        $node = $this->loadEntityById($id);
        $view = $this->view($node, 200)
        ->setTemplate('node/view/standard.html.twig')
        ->setTemplateVar('node');
        return $this->handleView($view);
    }
    
    /**
     * @Route("/node/{id}/law.{_format}", defaults={"_format"="html"})
     */
    public function law(int $id): RedirectResponse
    {
        $lawId = $this->loadEntityById($id)->getLaw()->getId();
        return $this->redirectToRouteById('app_law_show',$lawId);
    }
    
    /**
     * @Route("/node/{id}/parents.{_format}", defaults={"_format"="html"})
     */
    public function parents(int $id):Response{
        /**
         * @todo Implement
         */
    }
    
    /**
     * @Route("/node/{id}/childs.{_format}", defaults={"_format"="html"})
     */
    public function childs(int $id):Response{
        /**
         * @todo Implement
         */
    }
    
    protected function setEntityName(): void
    {
        $this->entityName = Node::class;
    }
}
