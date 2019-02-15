<?php

namespace App\Domain\MVCManagement;

use FOS\RestBundle\View\View;

/**
 * @author kevinfrantz
 */
final class MVCRoutineService implements MVCRoutineServiceInterface
{
    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\MVCManagement\MVCRoutineServiceInterface::process()
     */
    public function process(): void
    {
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\MVCManagement\MVCRoutineServiceInterface::getView()
     */
    public function getView(): View
    {
    }
}
