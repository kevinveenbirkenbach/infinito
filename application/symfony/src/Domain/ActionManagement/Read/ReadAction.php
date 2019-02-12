<?php

namespace App\Domain\ActionManagement\Read;

use App\Domain\ActionManagement\AbstractAction;

/**
 * @author kevinfrantz
 */
final class ReadAction extends AbstractAction implements ReadActionInterface
{
    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\AbstractAction::isSecure()
     */
    protected function isSecure(): bool
    {
        return $this->actionService->isRequestedActionSecure();
    }

    /**
     * @todo Implement!
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\AbstractAction::isValid()
     */
    protected function isValid(): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\AbstractAction::proccess()
     */
    protected function proccess()
    {
        return $this->actionService->getRequestedAction()->getRequestedEntity()->getEntity();
    }
}
