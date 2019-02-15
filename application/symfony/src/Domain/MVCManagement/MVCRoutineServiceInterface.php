<?php

namespace App\Domain\MVCManagement;

use FOS\RestBundle\View\View;

/**
 * This interface offers the options to process an MVC routine.
 *
 * @author kevinfrantz
 */
interface MVCRoutineServiceInterface
{
    /**
     * Process the injected services.
     */
    public function process(): void;

    /**
     * @return View
     */
    public function getView(): View;
}
