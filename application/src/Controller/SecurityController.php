<?php
namespace App\Controller;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 *
 * @author kevinfrantz
 *        
 */
class SecurityController extends AbstractController
{
    /**
     *
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        if ($error) {
            $this->addFlash('danger', $error->getMessage());
        }else{
            $this->addFlash('success', "User loged in.");
        }
        $this->addFlash('info', $authenticationUtils->getLastUsername());
        return $this->render("user/login.html.twig",[
            'last_username'=>$authenticationUtils->getLastUsername(),
        ]);
    }
}

