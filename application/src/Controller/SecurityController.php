<?php

namespace App\Controller;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @author kevinfrantz
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils, TranslatorInterface $translator): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        if ($error) {
            $this->addFlash('danger', $translator->trans($error->getMessageKey(), $error->getMessageData(), 'security'));
        } else {
            $lastUsername = $authenticationUtils->getLastUsername();
            if ($lastUsername) {
                $this->addFlash('success', $translator->trans('User %user% loged in.', ['%user%' => $lastUsername]));
            }
        }

        return $this->render('user/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
        ]);
    }
}
