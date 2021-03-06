<?php

namespace Infinito\Domain\Request\Action;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Infinito\Exception\Collection\ContainsElementException;
use Infinito\Exception\Collection\NotSetElementException;

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
     * @see \Infinito\Domain\Request\Action\RequestedActionStackInterface::containesRequestedAction()
     */
    public function containesRequestedAction(string $actionType): bool
    {
        return $this->requestedActions->containsKey($actionType);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Request\Action\RequestedActionStackInterface::addRequestedAction()
     */
    public function addRequestedAction(RequestedActionInterface $requestedAction): void
    {
        $key = $requestedAction->getActionType();
        if ($this->containesRequestedAction($key)) {
            throw new ContainsElementException("The key is allready set <<$key>>!");
        }
        $this->requestedActions->set($key, $requestedAction);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Request\Action\RequestedActionStackInterface::getAllRequestedActions()
     */
    public function getAllRequestedActions(): Collection
    {
        return $this->requestedActions;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Request\Action\RequestedActionStackInterface::getRequestedAction()
     */
    public function getRequestedAction(string $actionType): RequestedActionInterface
    {
        if ($this->requestedActions->containsKey($actionType)) {
            return $this->requestedActions->get($actionType);
        }
        throw new NotSetElementException(RequestedActionInterface::class." object for action type <<$actionType>> was not set!");
    }
}
