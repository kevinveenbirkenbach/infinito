<?php

namespace App\Domain\FormManagement;

use App\Entity\EntityInterface;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Allowes to create an form which fits to an entity.
 *
 * @author kevinfrantz
 */
interface EntityFormBuilderServiceInterface
{
    /**
     * @param EntityInterface $entity
     *
     * @return FormBuilderInterface
     */
    public function create(EntityInterface $entity): FormBuilderInterface;
}
