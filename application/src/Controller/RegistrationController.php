<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    /**
     * @var User
     */
    private $user;

    /**
     * @Route("/register", name="user_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, TranslatorInterface $translator): Response
    {
        $this->user = new User();
        $form = $this->createForm(UserType::class, $this->user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->encodePassword($passwordEncoder);
            $this->saveUser($translator);

            return $this->redirectToRoute('login');
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function encodePassword(UserPasswordEncoderInterface $passwordEncoder): void
    {
        $password = $passwordEncoder->encodePassword($this->user, $this->user->getPlainPassword());
        $this->user->setPassword($password);
    }

    private function saveUser(TranslatorInterface $translator): void
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($this->user);
        try {
            $entityManager->flush();
            $this->addFlash('success', $translator->trans('User "%username%" created!', ['%username%' => $this->user->getUsername()]));
        } catch (\Exception $exception) {
            $this->addFlash('danger', $translator->trans('User "%username%" could not be created!', ['%username%' => $this->user->getUsername()]));
        }
    }
}
