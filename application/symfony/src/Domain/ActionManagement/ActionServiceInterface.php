<?php

namespace App\Domain\ActionManagement;

use App\Domain\RequestManagement\Action\RequestedActionInterface;

/**
 * This interface offers all classes for managing an Action.
 *
 * @author kevinfrantz
 */
interface ActionServiceInterface
{
    /**
     * @return RequestedActionInterface Returns the requested action
     */
    public function getRequestedAction(): RequestedActionInterface;

    /**
     * @return bool true if the action permissions are right
     */
    public function isRequestedActionSecure(): bool;
}
