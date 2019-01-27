<?php

namespace App\Domain\ActionManagement;

use App\Domain\RequestManagement\Action\RequestedActionInterface;
use App\Domain\SecureManagement\SecureRequestedRightCheckerInterface;

/**
 * @author kevinfrantz
 */
final class ActionService implements ActionServiceInterface
{
    /**
     * @var RequestedActionInterface
     */
    private $requestedAction;

    /**
     * @var SecureRequestedRightCheckerInterface
     */
    private $secureRequestedRightChecker;

    /**
     * @param RequestedActionInterface $requestedAction
     */
    public function __construct(RequestedActionInterface $requestedAction, SecureRequestedRightCheckerInterface $secureRequestedRightChecker)
    {
        $this->requestedAction = $requestedAction;
        $this->secureRequestedRightChecker = $secureRequestedRightChecker;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\ActionServiceInterface::getRequestedAction()
     */
    public function getRequestedAction(): RequestedActionInterface
    {
        return $this->requestedAction;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\ActionServiceInterface::isRequestedActionSecure()
     */
    public function isRequestedActionSecure(): bool
    {
        return $this->secureRequestedRightChecker->check($this->requestedAction);
    }
}
