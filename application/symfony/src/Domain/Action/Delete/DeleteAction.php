<?php

namespace Infinito\Domain\Action\Delete;

use Infinito\Domain\Action\AbstractAction;

/**
 * @author kevinfrantz
 * Declare as not final as soon as you need it!
 */
final class DeleteAction extends AbstractAction
{
    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Action\AbstractAction::isSecure()
     */
    protected function isSecure(): bool
    {
        return $this->isSecure();
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
        $entityManager = $this->actionService->getEntityManager();
        $entity = $this->actionService->getRequestedAction()->getRequestedEntity()->getEntity();
        $entityManager->remove($entity);
    }
}
