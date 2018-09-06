<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 *
 * @author kevinfrantz
 *        
 */
class UserController extends AbstractController implements UserControllerInterface
{

    /**
     *
     * @Route("/user/logout", name="user_logout")
     */
    public function logout(): Response
    {
        return $this->render("user/login.html.twig");
    }

    /**
     *
     * @Route("/user/register", name="user_register")
     */
    public function register(): Response
    {
        return $this->render("user/register.html.twig");
    }
}