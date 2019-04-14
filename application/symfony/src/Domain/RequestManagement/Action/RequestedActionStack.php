<?php

namespace Infinito\Domain\RequestManagement\Action;

use Doctrine\Common\Collections\Collection;
use Infinito\Domain\ReInfinito\Management\RequestedActionStackInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Infinito\Exception\AllreadySetException;
use Infinito\Exception\NotSetException;

/**
 * @author kevinfrantz
 */
class RequestedActionStack implements RequestedActionStackInterface
{
    /**
     * @var RequestedActionInterface[]|Collection
     */
    private $requestedActions;

    public function __construct()
    {
        $this->requestedActions = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ReInfinito\Management\RequestedActionStackInterface::containesRequestedAction()
     */
    public function containesRequestedAction(string $actionType): bool
    {
        return $this->requestedActions->containsKey($actionType);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ReInfinito\Management\RequestedActionStackInterface::addRequestedAction()
     */
    public function addRequestedAction(RequestedActionInterface $requestedAction): void
    {
        $key = $requestedAction->getActionType();
        if ($this->containesRequestedAction($key)) {
            throw new AllreadySetException("The key is allready set <<$key>>!");
        }
        $this->requestedActions->set($key, $requestedAction);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ReInfinito\Management\RequestedActionStackInterface::getAllRequestedActions()
     */
    public function getAllRequestedActions(): Collection
    {
        return $this->requestedActions;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ReInfinito\Management\RequestedActionStackInterface::getRequestedAction()
     */
    public function getRequestedAction(string $actionType): RequestedActionInterface
    {
        if ($this->requestedActions->containsKey($actionType)) {
            return $this->requestedActions->get($actionType);
        }
        throw new NotSetException(RequestedActionInterface::class." object for action type <<$actionType>> was not set!");
    }
}
