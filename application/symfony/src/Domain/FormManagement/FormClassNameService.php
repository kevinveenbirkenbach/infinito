<?php

namespace App\Domain\FormManagement;

/**
 * @author kevinfrantz
 */
final class FormClassNameService implements FormClassNameServiceInterface
{
    const ENTITY_BASE_PATH = 'App\\Entity';

    const FORM_BASE_PATH = 'App\\Form';

    const SUFFIX = 'Type';

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\FormManagement\FormClassNameServiceInterface::getClass()
     */
    public function getClass(string $origineClass): string
    {
        $replaced = str_replace(self::ENTITY_BASE_PATH, self::FORM_BASE_PATH, $origineClass);
        $withSuffix = $replaced.self::SUFFIX;

        return $withSuffix;
    }
}
