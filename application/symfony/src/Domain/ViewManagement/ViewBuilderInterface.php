<?php

namespace Infinito\Domain\ViewManagement;

use FOS\RestBundle\View\View;
use Infinito\Domain\ActionManagement\ActionServiceInterface;

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
