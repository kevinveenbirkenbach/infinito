<?php

namespace Infinito\Repository;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * @author kevinfrantz
 */
interface RepositoryInterface extends ObjectRepository, Selectable
{
}
