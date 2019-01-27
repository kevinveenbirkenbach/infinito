<?php

namespace App\Domain\ActionManagement\Create;

use App\Domain\ActionManagement\AbstractAction;

/**
 * @author kevinfrantz
 */
abstract class AbstractCreateAction extends AbstractAction implements CreateActionInterface
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
}
