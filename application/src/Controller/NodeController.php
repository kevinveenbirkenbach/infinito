<?php

namespace App\Controller;

use FOS\RestBundle\Controller\FOSRestController;
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
class NodeController extends FOSRestController
{
    /**
     * @Route("/node/{id}.{_format}", defaults={"_format"="html"})
     */
    public function show(Request $request, int $id): Response
    {
        $node = $this->loadSource($request, $id);
        $view = $this->view($node, 200)
        ->setTemplate('node/view/standard.html.twig')
        ->setTemplateVar('node');

        return $this->handleView($view);
    }

    private function loadSource(Request $request, int $id): NodeInterface
    {
        $node = $this->getDoctrine()
        ->getRepository(Node::class)
        ->find($id);
        if (!$node) {
            throw $this->createNotFoundException('No node found for id '.$id);
        }
        return $node;
    }
}
