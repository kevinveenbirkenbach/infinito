<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\Meta\RelationInterface;
use App\Entity\Meta\Relation;

/**
 * @todo IMPLEMENT SECURITY!
 * @todo Refactor!
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
         * @var RelationInterface $node
         */
        $relation = $this->loadEntityById($id);
        $view = $this->view($relation, 200)
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
        $this->entityName = Relation::class;
    }
}
