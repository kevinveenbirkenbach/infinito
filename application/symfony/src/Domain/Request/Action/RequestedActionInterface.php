<?php

namespace Infinito\Domain\Request\Action;

use Infinito\Attribut\ActionTypeAttributInterface;
use Infinito\Domain\Request\User\RequestedUserInterface;

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
