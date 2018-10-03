<?php
namespace App\Entity;

use FOS\UserBundle\Model\UserInterface as FOSUserInterface;
use App\Entity\Attribut\Interfaces\SourceAttributInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
interface UserInterface extends FOSUserInterface, SourceAttributInterface
{
    
}