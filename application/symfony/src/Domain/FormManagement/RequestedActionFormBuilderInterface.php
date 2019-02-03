<?php

namespace App\Domain\FormManagement;

use Symfony\Component\Form\FormBuilderInterface;
use App\Domain\RequestManagement\Action\RequestedActionInterface;

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
