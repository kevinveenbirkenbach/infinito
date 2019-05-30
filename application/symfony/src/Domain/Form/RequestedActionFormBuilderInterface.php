<?php

namespace Infinito\Domain\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Infinito\Domain\Request\Action\RequestedActionInterface;

/**
 * Allowes to create an form which fits to an entity.
 *
 * @author kevinfrantz
 */
interface RequestedActionFormBuilderInterface
{
    /**
     * @param RequestedActionInterface $requestedAction
     *
     * @return FormBuilderInterface
     */
    public function create(RequestedActionInterface $requestedAction): FormBuilderInterface;
}
