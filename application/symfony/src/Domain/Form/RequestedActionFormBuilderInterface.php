<?php

namespace Infinito\Domain\Form;

use Infinito\Domain\Request\Action\RequestedActionInterface;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Allowes to create an form which fits to an entity.
 *
 * @author kevinfrantz
 */
interface RequestedActionFormBuilderInterface
{
    public function create(RequestedActionInterface $requestedAction): FormBuilderInterface;
}
