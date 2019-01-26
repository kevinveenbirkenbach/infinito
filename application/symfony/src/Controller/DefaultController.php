<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

/**
 * This controller offers the standart routes for the template.
 *
 * @author kevinfrantz
 */
final class DefaultController extends AbstractController
{
    /**
     * @deprecated Use load via source instead of fixed route
     *
     * @todo Optimize function!
     * @Route("/imprint.{_format}", defaults={"_format"="json"}, name="imprint")
     */
    public function imprint(EntityManagerInterface $entityManager): Response
    {
    }

    /**
     * @Route("/", name="homepage")
     */
    public function homepage(): Response
    {
        return $this->render('standard/homepage.html.twig');
    }
}
