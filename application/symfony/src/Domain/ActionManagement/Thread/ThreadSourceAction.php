<?php

namespace App\Domain\ActionManagement\Thread;

/**
 * @author kevinfrantz
 */
final class ThreadSourceAction extends AbstractThreadAction
{
    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\AbstractAction::isSecure()
     */
    protected function isSecure(): bool
    {
    }

    protected function isValidByForm(): bool
    {
    }

    protected function proccess()
    {
    }
}
