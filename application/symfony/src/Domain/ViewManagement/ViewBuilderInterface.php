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
     * @var string The path to the general entity template
     */
    const TWIG_ENTITY_TEMPLATE_PATH = 'entity/entity.html.twig';

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
