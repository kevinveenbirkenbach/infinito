<?php

namespace Infinito\Domain\Core;

use FOS\RestBundle\View\View;
use Infinito\Attribut\ActionTypeAttributInterface;

/**
 * This interface offers the options to process an Core routine.
 *
 * @author kevinfrantz
 */
interface CoreServiceInterface extends ActionTypeAttributInterface
{
    /**
     * Process through the layers.
     *
     * @return View
     */
    public function process(): View;
}
