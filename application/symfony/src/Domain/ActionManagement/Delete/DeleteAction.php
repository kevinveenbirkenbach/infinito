<?php

namespace App\Domain\ActionManagement\Delete;

use App\Domain\ActionManagement\AbstractAction;

/**
 * @author kevinfrantz
 * Declare as not final as soon as you need it!
 */
final class DeleteAction extends AbstractAction
{
    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\AbstractAction::isSecure()
     */
    protected function isSecure(): bool
    {
        return $this->isSecure();
    }

    /**
     * @todo Implement!
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\AbstractAction::isValidByForm()
     */
    protected function isValidByForm(): bool
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
        $entityManager = $this->actionService->getEntityManager();
        $entity = $this->actionService->getRequestedAction()->getRequestedEntity()->getEntity();
        $entityManager->remove($entity);
    }
}