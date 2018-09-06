<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 *
 * @author kevinfrantz
 *        
 */
interface UserControllerInterface
{
    public function logout():Response;
    
    public function register():Response;
}
