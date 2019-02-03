<?php

namespace App\Domain\FormManagement;

use App\Entity\EntityInterface;

/**
 * @author kevinfrantz
 */
interface FormClassNameServiceInterface
{
    /**
     * @param EntityInterface $entity
     *
     * @return string The name of the form of the entity
     */
    public function getClass(string $origineClass): string;
}
