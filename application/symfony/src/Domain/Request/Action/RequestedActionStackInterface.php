<?php

namespace Infinito\Domain\Request\Action;

use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 */
interface RequestedActionStackInterface
{
    /**
     * @param RequestedActionInterface $requestedAction
     */
    public function addRequestedAction(RequestedActionInterface $requestedAction): void;

    /**
     * @param string $actionType
     *
     * @return RequestedActionInterface
     */
    public function getRequestedAction(string $actionType): RequestedActionInterface;

    /**
     * @return Collection|RequestedActionInterface[] All requested actions
     */
    public function getAllRequestedActions(): Collection;

    /**
     * @param string $actionType
     *
     * @return bool True if the stack containes an RequestedAction to this action type
     */
    public function containesRequestedAction(string $actionType): bool;
}
