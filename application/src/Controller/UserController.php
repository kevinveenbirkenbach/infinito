<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->add('save', SubmitType::class,['label' => 'register'])
            ->getForm();
        return $this->render("user/register.html.twig",['form'=>$form->createView()]);
    }
}