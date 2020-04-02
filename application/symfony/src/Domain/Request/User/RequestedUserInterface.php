<?php

namespace Infinito\Domain\Request\User;

use Infinito\Domain\Request\Right\RequestedRightInterface;
use Infinito\Domain\User\UserSourceDirectorInterface;

/**
 * Offers a Service for managing the rights.
 *
 * @author kevinfrantz
 */
interface RequestedUserInterface extends RequestedRightInterface
{
    public function getUserSourceDirector(): UserSourceDirectorInterface;
}
