<?php

namespace Infinito\Entity;

use FOS\UserBundle\Model\UserInterface as FOSUserInterface;
use Infinito\Attribut\SourceAttributInterface;
use Infinito\Attribut\VersionAttributInterface;

/**
 * @author kevinfrantz
 */
interface UserInterface extends FOSUserInterface, SourceAttributInterface, VersionAttributInterface
{
}
