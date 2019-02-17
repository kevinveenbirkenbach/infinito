<?php

namespace Infinito\Domain\ActionManagement\Delete;

use Infinito\Domain\ActionManagement\AbstractAction;

/**
 * @author kevinfrantz
 * Declare as not final as soon as you need it!
 */
final class DeleteAction extends AbstractAction
{
    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ActionManagement\AbstractAction::isSecure()
     */
    protected function isSecure(): bool
    {
        return $this->isSecure();
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
        $entityManager = $this->actionService->getEntityManager();
        $entity = $this->actionService->getRequestedAction()->getRequestedEntity()->getEntity();
        $entityManager->remove($entity);
    }
}
