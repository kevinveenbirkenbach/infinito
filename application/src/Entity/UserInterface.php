<?php
namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
interface UserInterface extends SymfonyUserInterface, \Serializable
{
}

