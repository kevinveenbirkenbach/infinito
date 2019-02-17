<?php

namespace Infinito\Domain\RequestManagement\Action;

use Infinito\Attribut\ActionTypeAttributInterface;
use Infinito\Domain\RequestManagement\User\RequestedUserInterface;

/**
 * An action containes multiple attributes which are neccessary to process a request.
 *
 * @see ActionType
 *
 * @author kevinfrantz
 */
interface RequestedActionInterface extends ActionTypeAttributInterface, RequestedUserInterface
{
}
