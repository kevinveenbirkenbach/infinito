<?php

namespace App\Entity;

use FOS\UserBundle\Model\UserInterface as FOSUserInterface;
use App\Attribut\SourceAttributInterface;
use App\Attribut\VersionAttributInterface;

/**
 * @author kevinfrantz
 */
interface UserInterface extends FOSUserInterface, SourceAttributInterface, VersionAttributInterface
{
}
