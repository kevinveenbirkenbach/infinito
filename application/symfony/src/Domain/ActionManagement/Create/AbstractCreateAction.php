<?php

namespace Infinito\Domain\ActionManagement\Create;

use Infinito\Domain\ActionManagement\AbstractAction;

/**
 * @author kevinfrantz
 */
abstract class AbstractCreateAction extends AbstractAction implements CreateActionInterface
{
    /**
     * In general everybody should be allowed to create everything!
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ActionManagement\AbstractAction::isSecure()
     */
    protected function isSecure(): bool
    {
        return true;
    }
}
