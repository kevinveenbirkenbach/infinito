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
     * Process through the layers.
     *
     * @return View
     */
    public function process(): View;
}
