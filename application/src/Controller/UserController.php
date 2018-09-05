<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 *
 * @author kevinfrantz
 *        
 */
class UserController implements UserControllerInterface
{
    public function logout(): Response
    {}

    public function login(): Response
    {}

    public function register(): Response
    {}

}