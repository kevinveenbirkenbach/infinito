<?php

namespace App\Domain\ActionManagement\Create;

use App\Domain\ActionManagement\AbstractAction;

/**
 * @author kevinfrantz
 */
abstract class AbstractCreateAction extends AbstractAction implements CreateActionInterface
{
    /**
     * In general everybody should be allowed to create everything!
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\AbstractAction::isSecure()
     */
    protected function isSecure(): bool
    {
        return true;
    }
}
