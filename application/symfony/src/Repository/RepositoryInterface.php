<?php

namespace App\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

/**
 * @author kevinfrantz
 */
interface RepositoryInterface extends ObjectRepository, Selectable
{
}
