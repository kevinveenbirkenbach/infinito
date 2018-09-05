<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 * @author kevinfrantz
 *        
 */
class DefaultController extends AbstractController implements DefaultControllerInterface
{
    public function imprint(): Response
    {
        return new Response("Hello World!");
    }
    
    /**
     * Matches /
     *
     * @Route("/", name="homepage")
     */
    public function homepage(): Response
    {
        return $this->render("standard/homepage.html.twig",['menu_items'=>[]]);
    }
}

