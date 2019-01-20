<?php

namespace App\Domain\RequestManagement\Action;

use App\Entity\Attribut\ActionTypeAttributInterface;
use App\Domain\RequestManagement\User\RequestedUserInterface;

/**
 * An action containes multiple attributes which are neccessary to process a request.
 *
 * @see ActionType
 * @author kevinfrantz
 */
interface RequestedActionInterface extends ActionTypeAttributInterface, RequestedUserInterface
{
}
