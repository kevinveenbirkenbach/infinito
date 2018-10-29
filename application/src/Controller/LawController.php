<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Meta\Law;
use App\Entity\Meta\LawInterface;

/**
 * @author kevinfrantz
 *
 * @todo Implement security!
 */
class LawController extends AbstractEntityController
{
    /**
     * @Route("/law/{id}.{_format}", defaults={"_format"="html"})
     */
    public function show(int $id): Response
    {
        /**
         * @var LawInterface
         */
        $law = $this->loadEntityById($id);
        $view = $this->view($law, 200)
            ->setTemplate('law/view/standard.html.twig')
            ->setTemplateVar('law');

        return $this->handleView($view);
    }

    /**
     * @Route("/law/{id}/right.{_format}", defaults={"_format"="html"})
     */
    public function right(int $id): RedirectResponse
    {
        /*
         *
         * @todo Implement function!
         */
    }

    /**
     * @Route("/law/{id}/node.{_format}", defaults={"_format"="html"})
     */
    public function node(int $id): RedirectResponse
    {
        /*
         *
         * @todo Implement function!
         */
    }

    protected function setEntityName(): void
    {
        $this->entityName = Law::class;
    }
}
