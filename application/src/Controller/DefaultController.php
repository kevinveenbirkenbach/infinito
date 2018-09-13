<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author kevinfrantz
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/imprint", name="imprint")
     */
    public function imprint(): Response
    {
        return $this->render('standard/imprint.html.twig');
    }

    /**
     * @Route("/", name="homepage")
     */
    public function homepage(): Response
    {
        return $this->render('standard/homepage.html.twig');
    }
}
