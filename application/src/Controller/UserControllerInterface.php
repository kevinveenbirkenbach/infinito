<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @author kevinfrantz
 *        
 */
interface UserControllerInterface
{
    public function logout():Response;
    
    #public function register(Request $request):Response;
}
