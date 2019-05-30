<?php

namespace Infinito\Domain\Action\Read;

use Infinito\Domain\Action\AbstractAction;

/**
 * @author kevinfrantz
 */
final class ReadAction extends AbstractAction implements ReadActionInterface
{
    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Action\AbstractAction::isSecure()
     */
    protected function isSecure(): bool
    {
        return $this->actionService->isRequestedActionSecure();
    }

    /**
     * @todo Implement!
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Action\AbstractAction::isValid()
     */
    protected function isValid(): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Action\AbstractAction::proccess()
     */
    protected function proccess()
    {
        return $this->actionService->getRequestedAction()->getRequestedEntity()->getEntity();
    }
}
