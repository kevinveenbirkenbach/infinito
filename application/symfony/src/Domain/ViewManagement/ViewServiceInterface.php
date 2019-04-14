<?php

namespace Infinito\Domain\ViewManagement;

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
