<?php

namespace Infinito\Domain\View;

use FOS\RestBundle\View\View;

/**
 * @author kevinfrantz
 */
interface ViewServiceInterface
{
    /**
     * @return View
     */
    public function getView(): View;
}
