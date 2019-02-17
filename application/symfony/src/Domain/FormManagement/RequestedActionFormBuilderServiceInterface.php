<?php

namespace Infinito\Domain\FormManagement;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * @author kevinfrantz
 */
interface RequestedActionFormBuilderServiceInterface extends RequestedActionFormBuilderInterface
{
    /**
     * @return FormBuilderInterface Created by RequestedActionService
     */
    public function createByService(): FormBuilderInterface;
}
