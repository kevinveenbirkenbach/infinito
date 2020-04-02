<?php

namespace Infinito\Domain\View;

use FOS\RestBundle\View\View;

/**
 * @author kevinfrantz
 */
interface ViewServiceInterface
{
    public function getView(): View;
}
