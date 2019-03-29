<?php

namespace Infinito\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;

/**
 * @author kevinfrantz
 */
abstract class AbstractController extends AbstractFOSRestController
{
    /**
     * @var string
     */
    const FORMAT_PARAMETER_KEY = '_format';

    /**
     * @var string
     */
    const LOCALE_PARAMETER_KEY = '_locale';
}
