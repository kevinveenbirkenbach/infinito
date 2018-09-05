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
    public function modify(int $id): Response
    {}

    public function logout(): Response
    {}

    public function activate(): Response
    {}

    public function create(): Response
    {}

    public function login(): Response
    {}

    public function delete(): Response
    {}

    public function register(): Response
    {}

    public function deactivate(): Response
    {}

}

