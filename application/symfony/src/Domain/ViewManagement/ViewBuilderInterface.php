<?php

namespace App\Domain\ViewManagement;

use FOS\RestBundle\View\View;
use App\Domain\ActionManagement\ActionServiceInterface;

/**
 * @author kevinfrantz
 */
interface ViewBuilderInterface
{
    /**
     * @return View
     */
    public function getView(): View;

    /**
     * @return ActionServiceInterface
     */
    public function getActionService(): ActionServiceInterface;

    /**
     * Builds the view.
     */
    public function build(): void;
}
