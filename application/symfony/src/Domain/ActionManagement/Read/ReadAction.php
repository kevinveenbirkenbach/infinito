<?php

namespace Infinito\Domain\ActionManagement\Read;

use Infinito\Domain\ActionManagement\AbstractAction;

/**
 * @author kevinfrantz
 */
final class ReadAction extends AbstractAction implements ReadActionInterface
{
    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ActionManagement\AbstractAction::isSecure()
     */
    protected function isSecure(): bool
    {
        return $this->actionService->isRequestedActionSecure();
    }

    /**
     * @todo Implement!
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ActionManagement\AbstractAction::isValid()
     */
    protected function isValid(): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ActionManagement\AbstractAction::proccess()
     */
    protected function proccess()
    {
        return $this->actionService->getRequestedAction()->getRequestedEntity()->getEntity();
    }
}
