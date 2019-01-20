<?php

namespace App\Domain\ViewManagement;

use FOS\RestBundle\View\View;

/**
 * @author kevinfrantz
 */
interface ViewBuilderInterface
{
    /**
     * @return View
     */
    public function getView(): View;
}
