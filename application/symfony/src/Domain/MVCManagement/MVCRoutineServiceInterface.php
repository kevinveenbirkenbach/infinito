<?php

namespace Infinito\Domain\MVCManagement;

use FOS\RestBundle\View\View;
use Infinito\Attribut\ActionTypeAttributInterface;

/**
 * This interface offers the options to process an MVC routine.
 *
 * @author kevinfrantz
 */
interface MVCRoutineServiceInterface extends ActionTypeAttributInterface
{
    /**
     * Process through the layers.
     *
     * @return View
     */
    public function process(): View;
}
