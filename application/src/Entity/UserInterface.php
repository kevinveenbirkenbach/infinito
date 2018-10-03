<?php
namespace App\Entity\Interfaces;

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