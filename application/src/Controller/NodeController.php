<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\NodeInterface;
use App\Entity\Node;

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
    
    protected function setEntityName(): void
    {
        $this->entityName = Node::class;
    }
}
