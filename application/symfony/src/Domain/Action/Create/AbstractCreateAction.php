<?php

namespace Infinito\Domain\Action\Create;

use Infinito\Domain\Action\AbstractAction;

/**
 * @author kevinfrantz
 */
abstract class AbstractCreateAction extends AbstractAction implements CreateActionInterface
{
    /**
     * In general everybody should be allowed to create everything!
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Action\AbstractAction::isSecure()
     */
    protected function isSecure(): bool
    {
        return true;
    }
}
