<?php
namespace App\Entity\Attribut;

use App\Entity\User;

/**
 *
 * @author kevinfrantz
 *        
 */
interface UserAttributInterface
{
    public function setUser(User $user):void;
    
    public function getUser():User;
}

