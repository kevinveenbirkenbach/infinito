<?php

namespace App\Domain\FormManagement;

use Symfony\Component\Form\FormBuilderInterface;
use App\Domain\RequestManagement\Entity\RequestedEntity;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;

/**
 * Allowes to create an form which fits to an entity.
 *
 * @author kevinfrantz
 */
interface RequestedEntityFormBuilderServiceInterface
{
    /**
     * @param RequestedEntityInterface $requestedEntity
     *
     * @return FormBuilderInterface
     */
    public function create(RequestedEntityInterface $requestedEntity): FormBuilderInterface;
}
