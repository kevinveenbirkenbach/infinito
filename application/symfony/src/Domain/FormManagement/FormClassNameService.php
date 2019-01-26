<?php

namespace App\Domain\FormManagement;

use App\Entity\EntityInterface;

/**
 * @author kevinfrantz
 */
final class FormClassNameService implements FormClassNameServiceInterface
{
    const ENTITY_BASE_PATH = 'App\\Entity';

    const FORM_BASE_PATH = 'App\\Form';

    const SUFFIX = 'Type';

    /**
     * @param EntityInterface $entity
     *
     * @return string
     */
    public function getName(EntityInterface $entity): string
    {
        $class = get_class($entity);
        $replaced = str_replace(self::ENTITY_BASE_PATH, self::FORM_BASE_PATH, $class);
        $withSuffix = $replaced.self::SUFFIX;

        return $withSuffix;
    }
}
