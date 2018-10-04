<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Law;

/**
 *
 * @author kevinfrantz
 * @todo Implement security!
 */
class LawController extends AbstractEntityController
{

    /**
     *
     * @Route("/law/{id}.{_format}", defaults={"_format"="html"})
     */
    public function show(): Response
    {
    /**
     *
     * @todo Implement function!
     */
    }

    /**
     *
     * @Route("/law/{id}/right.{_format}", defaults={"_format"="html"})
     */
    public function right(int $id): RedirectResponse
    {
    /**
     *
     * @todo Implement function!
     */
    }

    /**
     *
     * @Route("/law/{id}/node.{_format}", defaults={"_format"="html"})
     */
    public function node(int $id): RedirectResponse
    {
    /**
     *
     * @todo Implement function!
     */
    }

    protected function setEntityName(): void
    {
        $this->entityName = Law::class;
    }
}